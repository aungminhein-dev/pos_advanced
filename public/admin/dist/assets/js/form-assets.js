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

const addSubCategory = (event) => {
    const subCategories = document.getElementById('subCategories');

    // Clear existing options before making the AJAX request
    subCategories.innerHTML = '<option disabled selected>Select sub-category</option>';

    $.ajax({
        url: '/admin/sub-categories/list',
        method: 'get',
        data: {
            categoryId: event.target.value
        },
        success: function (responses) {
            // Check if responses is empty
            if (responses.length === 0) {
                // Clear the select box if there is no data
                subCategories.innerHTML = '<option disabled selected>Select sub-category</option>';
            } else {
                // Populate the select box if there is data
                responses.forEach(subCategory => {
                    subCategories.insertAdjacentHTML('beforeend', `
                        <option value="${subCategory.id}">${subCategory.name}</option>
                    `);
                });
            }
        },

    });
};



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
const addTags = () => {
    let tagInput = document.getElementById("tag-input");
    let tag = tagInput.value;

    if (!tag) {
        return;
    }

    const tagsContainer = document.querySelector('.tagsContainer');
    tagsContainer.insertAdjacentHTML('beforeend', `
        <label class="selectgroup-item">
            <input type="checkbox" checked onchange="checkAllSelected()" name="tags[]" value="${"#" + tag}" class="selectgroup-input">
            <span class="selectgroup-button">#${tag}</span>
        </label>`
    );
    tagInput.value = '';
}

const toggleCalendar = () => {
    document.querySelector('#calendar').classList.remove('d-none');
}




