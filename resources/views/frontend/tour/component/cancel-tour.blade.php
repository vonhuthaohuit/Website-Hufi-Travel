<div class="box-cancel-tour">
    <div class="form-cancel-tour">
        <div class="cancel-group mb-3 mt-3" align="center">
            <!-- Close button -->
            <button id="close-box-cancel">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                    <path fill="#fff"
                        d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                </svg>
            </button>

            <!-- Form -->
            <form class="form-cancel" role="cancel" action="{{ route('tour.cancelTour') }}" method="POST">
                @csrf
                <p class="title-cancel mb-3 text-center">Hủy tour</p>
                <input type="hidden" name="matour" value="{{ $tour->phieuDatTour->tour->matour }}">
                <input type="hidden" name="maphieudattour" value="{{ $tour->phieuDatTour->maphieudattour }}">
                <p style="text-align: justify;">Chúng tôi rất tiếc khi biết rằng bạn đã quyết định hủy tour. Đây hẳn là
                    một quyết định không dễ dàng,
                    và chúng tôi hoàn toàn hiểu rằng có thể có những lý do cá nhân khiến bạn phải thay đổi kế hoạch. Tuy
                    nhiên, để đảm bảo quyền lợi của bạn và tránh những bất tiện không đáng có, chúng tôi khuyến khích
                    bạn vui lòng đọc kỹ quy định hủy tour của công ty. Những thông tin này sẽ giúp bạn hiểu rõ hơn về
                    các điều khoản, quyền lợi, và cách thức xử lý khi hủy tour. Nếu bạn cần hỗ trợ thêm, đội ngũ của
                    chúng tôi luôn sẵn sàng đồng hành cùng bạn.❤️</p>

                <select id="reasonDropdown" class="form-select mb-3" name="lydohuy" required>
                    <option value="">Lựa chọn lý do</option>
                    <option value="Không sắp xếp được thời gian">Không sắp xếp được thời gian</option>
                    <option value="Thay đổi kế hoạch cá nhân">Thay đổi kế hoạch cá nhân</option>
                    <option value="Vấn đề tài chính">Vấn đề tài chính</option>
                    <option value="Thời tiết không thuận lợi">Thời tiết không thuận lợi</option>
                    <option value="Khác">Khác</option>
                </select>

                <div id="customReasonContainer" class="form-group" style="display: none;">
                    <textarea id="customReason" name="custom_reason" class="form-control mt-2 content-comment"
                        placeholder="Nhập lý do hủy..."></textarea>
                </div>

                <div class="form-check mt-3 text-start">
                    <input type="checkbox" id="agreement" name="agreement" class="form-check-input" required>
                    <label class="form-check-label" for="agreement">
                        Tôi đồng ý với <a href="" style="text-decoration: underline; font-weight: 600;"
                            target="_blank">quy định hủy tour</a>.
                    </label>
                </div>

                <input type="submit" value="Hủy tour" class="btn btn-submit-cancel w-100 mt-3">
            </form>
        </div>
    </div>
</div>


@push('style')
    <link rel="stylesheet" href="{{ asset('frontend/css/styleComment.css') }}">
@endpush

@push('script')
    <script>
        function handleCancelTour() {
            var cancelTour = document.querySelectorAll('.btn-cancel-tour');
            var showCreate = document.querySelector('.box-cancel-tour');
            var formcancelTour = document.querySelector('.form-cancel-tour')

            cancelTour.forEach(function(btn) {
                btn.addEventListener('click', function(event) {
                    event.preventDefault();
                    formcancelTour.classList.add('zoom-in');
                    formcancelTour.classList.remove('zoom-out');
                    showCreate.classList.toggle('show');
                });
            });
        }

        function handleCloseCancelTour() {
            document.getElementById('close-box-cancel').addEventListener('click', function() {
                var commentBox = document.querySelector('.box-cancel-tour');
                var formcancelTour = document.querySelector('.form-cancel-tour');
                formcancelTour.classList.add('zoom-out');
                formcancelTour.classList.remove('zoom-in');
                setTimeout(function() {
                    commentBox.classList.remove('show');
                }, 300);
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            handleCancelTour();
            handleCloseCancelTour();
            const reasonDropdown = document.getElementById('reasonDropdown');
            const customReasonContainer = document.getElementById('customReasonContainer');

            reasonDropdown.addEventListener('change', function() {
                if (reasonDropdown.value === 'Khác') {
                    customReasonContainer.style.display = 'block';
                } else {
                    customReasonContainer.style.display = 'none';
                }
            });
        });
    </script>
@endpush
