<?php

namespace Database\Seeders;

use App\Models\NhanVien;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 50) as $index) {
            // Tạo User trước
            $user = User::create([
                'tentaikhoan' => $faker->userName,
                'matkhau' => bcrypt('password'), // Chú ý là phải mã hóa mật khẩu
                'trangthai' => "Hoạt động",
                'manhomquyen' => 1,
                'email' => $faker->unique()->safeEmail,
            ]);

            // Tạo NhanVien với mataikhoan từ User đã tạo
            NhanVien::create([
                'hoten' => $faker->name,
                'gioitinh' => $faker->randomElement(['Nam', 'Nữ']),
                'ngaysinh' => Carbon::createFromFormat('d-m-Y', '15-06-2000')->format('Y-m-d'),
                'sodienthoai' => $faker->phoneNumber,
                'bangcap' => 'Chưa có',
                'hinhdaidien' => 'Null',
                'ngayvaolam' => Carbon::now(),
                'maphongban' => 1,
                'mataikhoan' => $user->mataikhoan, // Lấy mataikhoan từ User
            ]);
        }
    }
}
