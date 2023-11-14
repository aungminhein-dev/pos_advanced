// images preview for products
const productImagePreview = (event) => {
    const files = event.target.files;
    const previewsContainer = document.querySelector('.previews-container');


    previewsContainer.innerHTML = ''; // Clear previous previews

    for (let i = 0; i < files.length; i++) {
        if (files[i].type.startsWith('image/')) {
            const image = document.createElement('img');
            image.src = URL.createObjectURL(files[i]);
            image.alt = 'Preview';
            image.classList.add('previews');
            previewsContainer.appendChild(image);

            const cross = document.createElement('i');
            cross.classList.add('fa-solid', 'fa-xmark');
            previewsContainer.appendChild(cross);
            cross.addEventListener('click', () => {
                previewsContainer.innerHTML = ''; // Clear previous previews
            })
        }
    }
}
let selected_color = '';
const changeColor = (event) => {
    selected_color = event.target.value;
}

// adding custom colors for product
const addColor = () => {
    // const container = document.getElementsByClassName('.gutters-xs');
    const container = document.getElementById('colorContainer');
    container.insertAdjacentHTML('beforeend', `
        <div class="col-auto">
            <label class="colorinput">
                <input name="colours[]" type="checkbox" value="${selected_color}" class="colorinput-input" />
                <span class="colorinput-color" style="background : ${selected_color}"></span>
            </label>
        </div>
    `);
}

// change category's input value
const addCategory1 = (event) => {
    const categoryInput = document.getElementById('categoryInput');
    categoryName = event.target.options[event.target.selectedIndex].getAttribute('data-category');
    categoryInput.value = categoryName;
}

// select all check boxes on a click
const selectPills = document.getElementById('selectgroup-pills');
const checkboxes = selectPills.querySelectorAll('input[type="checkbox"]');
const labels = selectPills.querySelectorAll('label');
const selectAll = (event) => {
    checkboxes.forEach(checkbox => {
        if (event.target.checked) {
            checkbox.checked = true;
        } else {
            checkbox.checked = false;
        }
    });
}
const alllabels = Array.from(labels);
const lastNode = selectPills.lastChild;
const filteredNodes = alllabels.filter((node) => node.id == '');
let allSelected = false;

// Function to check if all checkboxes are selected
const checkAllSelected = () => {
    allSelected = filteredNodes.every(label => {
        const checkbox = label.querySelector('input[type="checkbox"]');
        return checkbox.checked;
    });
    if (allSelected) {
        document.querySelector('#all-selected input[type="checkbox"]').checked = true;
    } else {
        document.querySelector('#all-selected input[type="checkbox"]').checked = false;
    }
};
filteredNodes.forEach(label => {
    const checkbox = label.querySelector('input[type="checkbox"]');
    checkbox.addEventListener('change', checkAllSelected);
});




