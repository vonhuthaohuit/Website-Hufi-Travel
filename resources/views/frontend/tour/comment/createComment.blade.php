<div class="box-create-comment">
    <div class="form-create-comment">
        <div class="comment-group mb-3 mt-3" align="center">
            <button id="close-box-comment">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                    <path fill="#fff"
                        d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                </svg>
            </button>

            <form class="form-comment" role="comment" action="{{ route('comment.insert') }}" method="POST">
                @csrf
                <p class="title-comment mb-3 text-center">Đánh giá tour</p>
                {{-- <input type="hidden" name="matour" value=""> --}}
                <div class="avaliacou" align="center">
                    <label for="star1" class="star-icon" data-avaliacao="1">
                        <input type="radio" name="diemdanhgia" id="star1" value="1">
                        <span class="title-comment-point">Rất tệ</span>
                    </label>
                    <label for="star2" class="star-icon" data-avaliacao="2">
                        <input type="radio" name="diemdanhgia" id="star2" value="2">
                        <span class="title-comment-point">Tệ</span>
                    </label>
                    <label for="star3" class="star-icon" data-avaliacao="3">
                        <input type="radio" name="diemdanhgia" id="star3" value="3">
                        <span class="title-comment-point">Tạm ổn</span>
                    </label>
                    <label for="star4" class="star-icon" data-avaliacao="4">
                        <input type="radio" name="diemdanhgia" id="star4" value="4">
                        <span class="title-comment-point">Tốt</span>
                    </label>
                    <label for="star5" class="star-icon" data-avaliacao="5">
                        <input type="radio" name="diemdanhgia" id="star5" value="5">
                        <span class="title-comment-point">Rất tốt</span>
                    </label>
                </div>
                <div class="form-group">
                    <textarea id="noidung" name="noidung" class="form-control mt-2 content-comment"
                        placeholder="Mời bạn chia sẻ thêm về cảm nhận..."></textarea>
                </div>
                <input type="submit" value="Gửi đánh giá" class="btn w-100 btn-submit-comment mt-3">
            </form>
        </div>
    </div>
</div>

@push('style')
    <link rel="stylesheet" href="{{ asset('frontend/css/styleComment.css') }}">
@endpush

@push('script')
    <script>
        function initializeRating() {
            var stars = document.querySelectorAll('.star-icon');
            var radioButtons = document.querySelectorAll('.avaliacou input');
            var titles = document.querySelectorAll('.title-comment-point');

            function updateStarStyling() {
                stars.forEach(function(star, index) {
                    var checked = radioButtons[index].checked;
                    star.classList.toggle('ativo', checked);
                    titles[index].classList.toggle('select', checked);
                });
            }

            document.addEventListener("click", function(e) {
                var classStar = e.target.classList;
                if (classStar.contains('star-icon')) {
                    var index = Array.from(stars).indexOf(e.target);
                    radioButtons[index].checked = !radioButtons[index].checked;
                    updateStarStyling();
                }
            });

            function setDefaultRating() {
                var checkedButton = Array.from(radioButtons).find(radioButton => radioButton.checked);
                if (!checkedButton) {
                    radioButtons[4].checked = true;
                    updateStarStyling();
                }
            }

            setDefaultRating();
        }

        // document.addEventListener("DOMContentLoaded", initializeRating);

        // $(document).ajaxComplete(function () {
        //     initializeRating();
        // });

        function handleCreateComment() {
            var createComment = document.querySelectorAll('.btn-create-comment');
            var showCreate = document.querySelector('.box-create-comment');
            var formCreateComment = document.querySelector('.form-create-comment')

            createComment.forEach(function(btn) {
                btn.addEventListener('click', function(event) {
                    event.preventDefault();
                    formCreateComment.classList.add('zoom-in');
                    formCreateComment.classList.remove('zoom-out');
                    showCreate.classList.toggle('show');
                });
            });
        }

        function handleCloseCommentBox() {
            document.getElementById('close-box-comment').addEventListener('click', function() {
                var commentBox = document.querySelector('.box-create-comment');
                var formCreateComment = document.querySelector('.form-create-comment')
                formCreateComment.classList.add('zoom-out');
                formCreateComment.classList.remove('zoom-in');
                setTimeout(function() {
                    commentBox.classList.remove('show');
                }, 300);
            });
        }
        document.addEventListener('DOMContentLoaded', function() {
            handleCreateComment();
            handleCloseCommentBox();
            initializeRating();
        });
    </script>
@endpush
