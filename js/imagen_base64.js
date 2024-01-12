function seleccionarImagen() {
    var input = document.createElement('input');
    input.type = 'file';
    input.accept = 'image/*';

    input.addEventListener('change', function () {
        var file = input.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var base64Image = e.target.result;
                document.getElementById("portada").value = base64Image;
            };
            reader.readAsDataURL(file);
        }
    });
    //input.click();
}