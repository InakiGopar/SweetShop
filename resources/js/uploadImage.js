document.addEventListener('DOMContentLoaded', () => {
    window.previewImage = (event) => {
        const reader = new FileReader();
        reader.onload =  () => {
            const output = document.createElement('img');
            output.src = reader.result;
            const preview = document.getElementById('image-preview');
            preview.innerHTML = ''; // Limpia cualquier imagen previa
            preview.appendChild(output);
        };
        reader.readAsDataURL(event.target.files[0]);
    };
});