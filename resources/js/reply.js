const replayBtn = document.querySelector('#reply');
const replayForm = document.querySelector('#reply-form');
replayBtn.addEventListener('click', function() {
    replayForm.classList.toggle('d-none');
})
