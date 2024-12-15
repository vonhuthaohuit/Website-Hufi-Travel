<?php

namespace App\Http\Controllers\backend;

use App\DataTables\TourDatatables;
use App\Http\Controllers\Controller;
use App\Http\Controllers\dattour\DatTourController;
use App\Models\ChiTietTour;
use App\Models\DiemDuLich;
use App\Models\KhachHang;
use App\Models\KhuyenMai;
use App\Models\LoaiKhachHang;
use App\Models\LoaiTour;
use App\Models\Tour;
use App\Models\User;
use App\Traits\ImageUploadTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use function Laravel\Prompts\search;

class TourController extends Controller
{
    use ImageUploadTrait;
    protected $datTourController;

    public function __construct()
    {
        $this->datTourController = new DatTourController();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(TourDatatables $dataTable)
    {
        return $dataTable->render('backend.tour.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $loaiTour = LoaiTour::all();
        $khuyenMai = KhuyenMai::all();
        return view('backend.tour.create', compact('loaiTour', 'khuyenMai'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'tentour' => 'required',
                'noikhoihanh' => 'required',
                'loaitour_id' => 'required|exists:loaitour,maloaitour',
                'hinhdaidien' => 'required|image',
            ]);

            $imagePath = $this->uploadImage($request, 'hinhdaidien', 'frontend/images/tour');
            if (!$imagePath) {
                return back()->withErrors(['hinhdaidien' => 'Hình ảnh không được tải lên.']);
            }
            $khuyenmai_ID = $request->khuyenmai_id;
            if (!$khuyenmai_ID) {
                $khuyenmai_ID = null;
            }
            $tour = new Tour();
            $tour->tentour = $request->tentour;
            $tour->slug = Str::slug($request->tentour);
            $tour->motatour = $request->motatour;
            $tour->tinhtrang = 2;
            $tour->giatour = 0;
            $tour->noikhoihanh = $request->noikhoihanh;
            $tour->thoigiandi = $request->thoigiandi;
            $tour->maloaitour = $request->loaitour_id;
            $tour->makhuyenmai = $request->khuyenmai_id ?? NULL;
            $tour->hinhdaidien = $imagePath;
            $tour->created_at =  Carbon::parse(now()->format('d-m-Y'));
            $tour->updated_at =  Carbon::parse(now()->format('d-m-Y'));
            $tour->save();
            return redirect()->route('tour.index')->with('success', 'Thêm thành công');
        } catch (Exception $e) {
            Log::error('Error in registration process:', ['error' => $e->getMessage()]);
            //    DB::statement('CALL updateTourStatus(?)', [$tour->matour]);
            return redirect()->route('tour.index');
        } catch (Exception $e) {
            Log::info("Sai");
            return redirect()->route('tour.index')->with('error', 'Thêm không thành công');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tour = Tour::where('matour', $id)->first();
        $khuyenMai = KhuyenMai::all();
        $loaiTour = LoaiTour::all();
        return view('backend.tour.edit', compact('tour', 'khuyenMai', 'loaiTour'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'tentour' => 'required|string|max:255',
                'tinhtrang' => 'required|string|max:100',
                'thoigiandi' => 'required',
                'hinhdaidien' => 'nullable|image',
                'noikhoihanh' => 'required|string|max:255',
                'loaitour_id' => 'required|exists:loaitour,maloaitour',
                'khuyenmai_id' => 'nullable|exists:khuyenmai,makhuyenmai',
            ]);
            $giatour =  DB::select('SELECT func_giatour(?) AS giatour', [$id]);
            $giatour = $giatour[0]->giatour ?? 0;
            $tour = Tour::where('matour', $id)->first();
            $tour->tentour = $request->input('tentour');
            $tour->slug = Str::slug($request->tentour);
            $tour->motatour = $request->input('motatour');
            $tour->tinhtrang = $request->input('tinhtrang');
            $tour->thoigiandi = $request->input('thoigiandi');
            $tour->giatour = $giatour;
            $tour->noikhoihanh = $request->input('noikhoihanh');
            $tour->maloaitour = $request->input('loaitour_id');
            $tour->makhuyenmai = $request->input('khuyenmai_id');
            $tour->updated_at =  Carbon::parse(now()->format('d-m-Y'));
            if ($request->hasFile('hinhdaidien')) {
                $imagePath = $this->updateImage($request, 'hinhdaidien', 'frontend/images/tour', $tour->hinhdaidien);
                $tour->hinhdaidien = $imagePath;
            } else {
                $tour->hinhdaidien = $tour->hinhdaidien;
            }
            $tour->save();
            DB::statement('CALL proc_updateTourStatus(?)', [$tour->matour]);
            return redirect()->route('tour.index')->with('success', 'Cập nhật tour thành công!');
        } catch (Exception $e) {
            Log::error('Error in registration process:', ['error' => $e->getMessage()]);
            return redirect()->route('tour.index')->with('error', 'Cập nhật tour không thành công!');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result =  DB::select('SELECT func_soluongKhachDat(?) AS soluong', [$id]);
        $soluong = $result[0]->soluong;
        if($soluong != 0)
        {
            return response()->json(['status' => 'error', 'message' => 'Tour đang hoạt đông! Xoá không thành công']);
        }
        $tour = Tour::find($id);
        $this->deleteImage($tour->hinhdaidien);
        $tour->delete();
        return response()->json(['status' => 'success', 'message' => 'Xóa thành công']);
    }

    public function changeStatus(Request $request)
    {
        $request->validate([
            'matour' => 'required',
            'tinhtrang' => 'required',
        ]);
        $tour = Tour::findOrFail($request->matour);
        $tour->tinhtrang = $request->tinhtrang === 'true' ? 1 : 0;
        $tour->save();
        return response()->json(['message' => 'Tình trạng cập nhật thành công!']);
    }


    public function countChuongTrinhTourofTour() {}


    public function searchTour(Request $request)
    {
        $searchData = $request->only(['typetour', 'name-destination', 'destination', 'departure', 'date-start', 'date-end', 'duration', 'guests', 'tour_star', 'hotel_star', 'gia']);
        $searchDataCount = count(array_filter($searchData));

        // if (!empty($searchData['date-start']) || !empty($searchData['date-end']) && isset($searchData['date-start']) && isset($searchData['date-end'])) {
        //     $searchData['date-start'] = !empty($searchData['date-start'])
        //         ? Carbon::createFromFormat('d/m/Y', $searchData['date-start'])->format('Y-m-d')
        //         : null;
        //     $searchData['date-end'] = !empty($searchData['date-end'])
        //         ? Carbon::createFromFormat('d/m/Y', $searchData['date-end'])->format('Y-m-d')
        //         : null;
        // }
        $images = [];
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->storeAs('temp', $image->getClientOriginalName());

            $pythonScript = base_path('app' . DIRECTORY_SEPARATOR . 'Traits' . DIRECTORY_SEPARATOR . 'model_ai' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'search_image.py');
            $imageFilePath = storage_path('app' . DIRECTORY_SEPARATOR . $imagePath);

            if (!file_exists($pythonScript)) {
                Log::error("File does not exist: " . $pythonScript);
                return response()->json(['error' => 'Python script not found.'], 404);
            }

            if (!file_exists($imageFilePath)) {
                Log::error("Image file does not exist: " . $imageFilePath);
                return response()->json(['error' => 'Image file not found.'], 404);
            }

            $command = "python \"$pythonScript\" \"$imageFilePath\" 2>&1";
            $output = shell_exec($command);

            $images = json_decode($output, true);
            if ($images) {
                $images = array_map(function($item) {
                    return str_replace('dataset\\', '', $item['path']);
                }, $images);

                $images = array_map(function ($image) {
                    return 'frontend/images/tour/' . $image;
                }, $images);
            } else {
                Log::error("No images returned from Python script.");
                $images = [];
            }
        }

        $typetourName = $searchData['typetour']
            ? optional(LoaiTour::find($searchData['typetour']))->tenloai
            : null;

        $destinationName = null;
        $destinationName_input = null;
        $destinationId = null;

        if (!empty($searchData['destination'])) {
            $destinationId = $searchData['destination'];
            $destinationName = optional(DiemDuLich::find($destinationId))->tendiemdulich;
            $destinationName_input = $destinationName;
        } elseif (!empty($searchData['name-destination'])) {
            $destinationName_input = $searchData['name-destination'];

            $destination = DiemDuLich::where('tendiemdulich', 'like', '%' . $searchData['name-destination'] . '%')->first();
            if ($destination) {
                $destinationId = $destination->madiemdulich;
                $destinationName = $destination->tendiemdulich;
            } else {
                $destinationId = null;
                $destinationName = null;
            }
        }

        if (!$destinationId) {
            $searchData['destination'] = '';
        }


        $giaMin = 0;
        $giaMax = $searchData['gia'] ?? 10000000;
        $tours = Tour::query()
            ->where('tinhtrang', 1)
            ->when(
                isset($searchData['typetour']) && !empty($searchData['typetour']),
                function ($query) use ($searchData) {
                    return $query->where('maloaitour', $searchData['typetour']);
                }
            )
            ->when(
                (isset($searchData['destination']) || isset($searchData['name-destination'])) &&
                    (!empty($searchData['destination']) || !empty($searchData['name-destination'])),
                fn($query) =>
                $query->whereHas(
                    'chitiettour.diemdulich',
                    fn($q) =>
                    $q->where('madiemdulich', $searchData['destination'] ?? $searchData['name-destination'])
                )
            )
            ->when(
                isset($searchData['departure']) && !empty($searchData['departure']) && $searchDataCount != 3,
                fn($query) => $query->where('noikhoihanh', 'like', '%' . $searchData['departure'] . '%')
            )
            ->when(
                isset($searchData['duration']) && !empty($searchData['duration']) && $searchDataCount != 3,
                fn($query) => $query->where('thoigiandi', 'like', '%' . $searchData['duration'] . '%')
            )
            ->when(
                isset($searchData['date-start']) && !empty($searchData['date-start']),
                fn($query) => $query->whereHas('chitiettour', fn($q) => $q->where('ngaybatdau', $searchData['date-start']))
            )
            ->when(
                isset($searchData['date-end']) && !empty($searchData['date-end']) && $searchDataCount != 3,
                fn($query) => $query->whereHas('chitiettour', fn($q) => $q->where('ngayketthuc', $searchData['date-end']))
            )
            ->when(
                isset($images) && !empty($images) && $searchDataCount != 3,
                fn($query) => $query->whereIn('hinhdaidien', $images)
            )
            ->when(
                isset($searchData['hotel_star']) && !empty($searchData['hotel_star']) && $searchDataCount != 3,
                fn($query) => $query->whereHas(
                    'chitietkhachsantour',
                    fn($q) =>
                    $q->whereHas(
                        'khachsan',
                        fn($q2) =>
                        $q2->whereIn('chatluong', array_keys($searchData['hotel_star']))
                    )
                )
            )
            ->when(
                isset($searchData['gia']) && !empty($searchData['gia']) && $searchDataCount != 3,
                fn($query) => $query->whereBetween('giatour', [(float)$giaMin, (float)$giaMax])
            )
            ->with([
                'khuyenmai',
                'loaitour',
                'hinhanhtour',
                'chitiettour',
                'chuongtrinhtour',
                'chitietkhachsantour',
                'chitietphuongtientour'
            ])
            ->get();

        $query = collect([

            isset($searchData['typetour']) && !empty($searchData['typetour']) ? "Loại tour: \"{$typetourName}\"" : null,

            (isset($searchData['destination']) || isset($searchData['name-destination'])) &&
                (!empty($searchData['destination']) || !empty($searchData['name-destination']))
                ? "Điểm đến: \"" . ($destinationName ?? $searchData['name-destination'] ?? '') . "\""
                : null,

            isset($searchData['departure']) && !empty($searchData['departure'])
                ? "Nơi khởi hành: \"{$searchData['departure']}\""
                : null,

            isset($searchData['duration']) && !empty($searchData['duration'])
                ? "Thời gian: \"{$searchData['duration']}\""
                : null,

            isset($searchData['date-start']) && !empty($searchData['date-start'])
                ? "Ngày bắt đầu: \"{$searchData['date-start']}\""
                : null,

            isset($searchData['date-end']) && !empty($searchData['date-end'])
                ? "Ngày kết thúc: \"{$searchData['date-end']}\""
                : null,


            isset($searchData['hotel_star']) && !empty($searchData['hotel_star'])
                ? "Đánh giá khách sạn: \"" . (is_array(array_keys($searchData['hotel_star'])) ? implode(', ', array_keys($searchData['hotel_star'])) : array_keys($searchData['hotel_star'])) . '⭐' . "\""
                : null,

            isset($searchData['gia']) && !empty($searchData['gia'])
                ? "Giá từ 0 đến: \"" . str_replace(',', ' ', number_format($searchData['gia'])) . 'đ' . "\""
                : null,


        ])->filter()->implode(', ');




        $tourCount = $tours->count();
        return view('frontend.tour.searchtour', compact('tours', 'tourCount', 'query'));
    }
    public function getTourDetails($tourId)
    {
        $tour = Tour::find($tourId);
        $loaiKhachHang = LoaiKhachHang::all();
        if ($tour) {
            $giaTour_LoaiKhachHang = $this->datTourController->TinhGiaTourLoaiKhachHang($tourId);

            return response()->json([
                'tentour' => $tour->tentour,
                'thoigiandi' => $tour->thoigiandi,
                'ngaybatdau' => optional($tour->chitiettour->first())->ngaybatdau,
                'noikhoihanh' => $tour->noikhoihanh,
                'giatour' => number_format($tour->giatour),
                'loaikhachhang' => $loaiKhachHang,
                'giatourloaikhachhang' => $giaTour_LoaiKhachHang,
            ]);
        }

        return response()->json([], 404);
    }
    public function uploadModel_Image(){
        $pythonScript = base_path('app' . DIRECTORY_SEPARATOR . 'Traits' . DIRECTORY_SEPARATOR . 'model_ai' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'store_vectors.py');
        $command = "python \"$pythonScript\" 2>&1";
        $output = system($command);
        return response()->json(['status' => 'success', 'message' => 'Upload model thành công']);
    }
}
