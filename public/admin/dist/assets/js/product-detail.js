let mainImage = document.querySelector('#pic-1 img');
imagesContainer = document.querySelectorAll('.preview-li');
const previewImages = document.querySelectorAll('.preview-li a img')

const changeImage = () => {
    imagesContainer.forEach(imageLi => {
        imageLi.addEventListener('click', (e) => {
            let image = imageLi.querySelector('a img').src;
            mainImage.src = image;
            activeImage();
        })
    });
}

const activeImage = () => {
    previewImages.forEach(image => {
        image.src == mainImage.src ? image.classList.add('border', 'border-dark') : image.classList
            .remove('border', 'border-dark')
    });
}
changeImage();
activeImage();

let productId;
let discountId;
const form = document.getElementById('edit'); // Replace 'your-form-id' with the actual ID of your form

const showForm = () => {
    form.classList.toggle('d-none');
    productId = document.getElementById('product-id').value;
    discountId = document.getElementById('discount-id').value;
};

const formClear = () => {
    form.classList.add('d-none');
    productId = '';
};

const save = (action) => {
    let url;
    let data;
    const originalPriceBox = document.querySelector('.originalPriceBox del');
    const percentageBox = document.getElementById('percentage');
    const currentPrice = document.querySelectorAll('.current-price');

    const originalPrice = parseFloat(originalPriceBox.innerHTML);
    const percentage = percentageBox.value;

    if (action === 'create') {
        data = {
            'percentage': percentage,
            'productId': productId,
        };
        url = '/admin/discount/add';
    } else {
        url = '/admin/discount/update';
        data = {
            'percentage': percentage,
            'id': discountId,
        };
    }

    $.ajax({
        url: url,
        method: 'post',
        data: data,
        success: function(response) {
            const discountedPrice = originalPrice - (originalPrice * (response.percentage / 100));
            currentPrice.forEach(element => {
                element.innerHTML = Math.round(discountedPrice);
            });
            const percentageSpan = document.querySelectorAll('.percentageSpan');

            percentageSpan.forEach(element => {
                element.innerHTML = '(-'+response.percentage+'%)'
            });
            formClear();
        },
        error: function(error) {
            console.log(error);
        }
    });
};
