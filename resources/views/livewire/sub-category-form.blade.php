<div class="">
    @foreach ($category->subCategories as $subC)
        @php
            $colorArray = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'];
            $indexer = $loop->index % count($colorArray);
            $color = $colorArray[$indexer];
        @endphp
        <span class="mt-2 badge badge-{{ $color }}">{{ $subC->name }} @if($subC->products->count() != 0) ({{ $subC->products->count() }}) @endif
            <i class="fa-solid fa-xmark" style="color: rgb(206, 183, 9)" wire:click="delete({{ $subC->id }})"></i></a></span>
    @endforeach
    <h3 class="section-title">Add Sub Category for this Category</h3>
    <form>

        <div class="form-group">
            <label for="">Sub Category Name</label>
            <input type="text" wire:model="subCategoryName" id="sub-category-name"
                class="form-control @error('name') is-invalid @enderror">
                <small class="text-danger"></small>
        </div>
        <button class="btn btn-success"  type="button" wire:click="add()">Add</button>
    </form>
</div>
