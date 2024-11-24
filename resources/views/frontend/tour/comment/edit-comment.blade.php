<div id="box-edit-comment-{{ $item->madanhgia }}" class="box-edit-comment" style="display: none;">
    <div class="form-edit-comment">
        <div class="comment-group mb-3 mt-3" align="center">
            <button class="close-box-comment" data-id="{{ $item->madanhgia }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                    <path fill="#fff"
                        d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                </svg>
            </button>

            <form class="form-edit" role="comment" action="{{ route('comment.update', $item->madanhgia) }}"
                method="POST">
                @csrf
                <p class="title-comment mb-3 text-center">Sửa bình luận</p>
                <input type="hidden" name="matour" value="{{ $item->matour }}">
                <div class="avaliacou" id="rating-{{ $item->madanhgia }}" align="center">
                    @for ($i = 1; $i <= 5; $i++)
                        <label for="star{{ $i }}-{{ $item->madanhgia }}" class="star-icon"
                            data-avaliacao="{{ $i }}">
                            <input type="radio" name="diemdanhgia" id="star{{ $i }}-{{ $item->madanhgia }}"
                                value="{{ $i }}" {{ $item->diemdanhgia == $i ? 'checked' : '' }}>
                            <span class="title-comment-point">
                                @switch($i)
                                    @case(1)
                                        Rất tệ
                                    @break

                                    @case(2)
                                        Tệ
                                    @break

                                    @case(3)
                                        Tạm ổn
                                    @break

                                    @case(4)
                                        Tốt
                                    @break

                                    @case(5)
                                        Rất tốt
                                    @break
                                @endswitch
                            </span>
                        </label>
                    @endfor
                </div>

                <div class="form-group">
                    <textarea id="noidung-{{ $item->madanhgia }}" name="noidung" class="form-control mt-2 content-comment">{{ $item->noidung }}</textarea>
                </div>
                <input type="submit" value="Sửa bình luận" class="btn w-100 btn-submit-comment mt-3">
            </form>
        </div>
    </div>
</div>

@push('style')
    <link rel="stylesheet" href="{{ asset('frontend/css/styleComment.css') }}">
@endpush

@push('script')
    <script>
        function initializeRatingForComment(commentId) {
            const container = document.querySelector(`#rating-${commentId}`);
            const stars = container.querySelectorAll('.star-icon');
            const radioButtons = container.querySelectorAll('input[type="radio"]');

            function updateStarStyling() {
                stars.forEach((star, index) => {
                    const radioButton = radioButtons[index];
                    if (radioButton.checked) {
                        star.classList.add('ativo');
                    } else {
                        star.classList.remove('ativo');
                    }
                });
            }

            radioButtons.forEach((radioButton) => {
                radioButton.addEventListener('change', updateStarStyling);
            });

            updateStarStyling();
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.btn-edit-comment').forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const id = this.getAttribute('data-id');
                    document.querySelector(`#box-edit-comment-${id}`).style.display = 'block';
                    initializeRatingForComment(id);
                });
            });

            document.querySelectorAll('.close-box-comment').forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const id = this.getAttribute('data-id');
                    document.querySelector(`#box-edit-comment-${id}`).style.display = 'none';
                });
            });
        });
    </script>
@endpush
