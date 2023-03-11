

{!! Form::open(['route' => ['manage-product.store'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
<div id="product-fields">
    <div class="product-field">
        <input type="text" name="name[]" placeholder="Product Name">
        <select name="brand_id[]" class="brand-select">
            <option value="">Select Brand</option>
            @foreach ($branddata as $brand)
                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
            @endforeach
        </select>
        <select name="category_id[]" class="category-select">
            <option value="">Select Category</option>
        </select>
        <select name="sub_category_id[]" class="subcategory-select">
            <option value="">Select Sub-Category</option>
        </select>
        <button type="button" class="remove-product">Remove</button>
    </div>
</div>
<button type="button" id="add-product">Add Product</button>
<button type="submit">Submit</button>
<script>
    $(document).ready(function() {
        // Add product field
        $('#add-product').click(function() {
            var html = `
<div class="product-field">
<input type="text" name="name[]" placeholder="Product Name">
<select name="brand_id[]" class="brand-select">
<option value="">Select Brand</option>
@foreach ($branddata as $brand)
<option value="{{ $brand->id }}">{{ $brand->name }}</option>
@endforeach
</select>
<select name="category_id[]" class="category-select">
<option value="">Select Category</option>
</select>
<select name="sub_category_id[]" class="subcategory-select">
<option value="">Select Sub-Category</option>
</select>
<button type="button" class="remove-product">Remove</button>
</div>
`;
            $('#product-fields').append(html);
        });
        // Remove product field
        $(document).on('click', '.remove-product', function() {
            $(this).closest('.product-field').remove();
        });
        // Populate category dropdown based on selected brand
        $(document).on('change', '.brand-select', function() {
            var brandId = $(this).val();
            var categorySelect = $(this).closest('.product-field').find('.category-select');
            var subcategorySelect = $(this).closest('.product-field').find('.subcategory-select');
            categorySelect.empty();
            categorySelect.append('<option value="">Select Category</option>');
            subcategorySelect.empty();
            subcategorySelect.append('<option value="">Select Sub-Category</option>');
            if (brandId) {
                $.ajax({
                    url: '/getCategoriesByBrandId/' + brandId,
                    type: 'GET',
                    success: function(response) {
                        if (response.categories) {
                            $.each(response.categories, function(key, value) {
                                categorySelect.append('<option value="' + key +
                                    '">' + value + '</option>');
                            });
                        }
                    }
                });
            }
        });
        // Populate subcategory dropdown based on selected category
        $(document).on('change', '.category-select', function() {
            var categoryId = $(this).val();
            var subcategorySelect = $(this).closest('.product-field').find('.subcategory-select');
            subcategorySelect.empty();
            subcategorySelect.append('<option value="">Select Sub-Category</option>');
            if (categoryId) {
                $.ajax({
                    url: '/getSubcategoriesByCategoryId/' + categoryId,
                    type: 'GET',
                    success: function(response) {
                        if (response.subcategories) {
                            $.each(response.subcategories, function(key, value) {
                                subcategorySelect.append('<option value="' + key +
                                    '">' + value + '</option>');
                            });
                        }
                    }
                });
            }
        });
    });
</script>
{!! Form::close() !!}




<div class = "product-field col-md-12">
    <div class="row">

                                                                    <div class="col-md-6 ">
                                                              <div class="form-group">
                                                                <label>Name</label>
                                                                <div class="controls">
                                                                  <input type="text" name="name[]" class="form-control" value="" required placeholder="Enter Product Name">
                                                                </div>
                                                              </div>
                                                              <div class="form-group">
                                                                <label>Brand</label>
                                                                <select name="brand_id[]" class="form-control brand-select select2" required>
                                                                  <option value="" selected="selected" disabled="">Select Brand</option>
                                                                  @foreach ($branddata as $key => $brand)
                                                                  <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                                  @endforeach
                                                                </select>
                                                              </div>
                                                              <div class="form-group">
                                                                <label>Category</label>
                                                                <select name="category_id[]" class="form-control category-select select2" required>
                                                                  <option value="" selected="selected" disabled="">Select Category</option>
                                                                </select>
                                                              </div>
                                                              <div class="form-group">
                                                                <label>Subcategory</label>
                                                                <select name="subcategory_id[]" class="form-control subcategory-select select2" required>
                                                                  <option value="" selected="selected" disabled="">Select Subcategory</option>
                                                                </select>
                                                              </div>

                                                              <div style="border: 4px solid transparent;"></div>
                                                          <div class="row">
                                                            <div class="col-md-12">
                                                              <div class="pull-right">

                                                                <button type="button" class="remove-product btn btn-success" class="">Remove</button>

                                                              </div>
                                                            </div>


                                                            </div>


<div class="col-md-6">
    <div class="form-group">
        <label>Description</label>
        <div class="controls">
          <input type="text" name="description[]" class="form-control" value="" required placeholder="Enter Product Description">
        </div>
      </div>

</div>
</div>
    </div>
</div>