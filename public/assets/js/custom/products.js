let editor1 = new RichTextEditor("#create_description");
let editor2 = new RichTextEditor("#edit_description");
let editor3 = new RichTextEditor("#detail_description");

$(document).ready(function() {
  $('.product-category-select2').select2({
    dropdownParent: $("#createProductModal")
  });

  $(".detail-product-data").on("click", function() {          
    $.ajax({
        type: "GET",
        url: `/admin/products/${$(this).closest('.table-body').find('.product_id').val()}`,              
        dataType: "json",
        success: function({product, categories}){
          $("#detail-thumbnail").attr("src", `/uploads/products/thumbnails/${product.thumbnail_img}`)
          $("#detail-title").val(product.title)
          $("#detail-category-product").val(product.product_category.name)
          $("#detail-price").val(rupiah(product.price))
          $("#detail-stock").val(product.stock)

          editor3.setReadOnly(true);    
          editor3.setHTMLCode(product.description)          

          $("#detail-product-images").html('')
          for(let i = 0; i < product.product_images.length; i++) {
            $("#detail-product-images").append(`
              <div class="col-3 mb-4">
                <img src="/uploads/products/images/${product.product_images[i].image}" class="border" width="100%" alt="">
              </div>
            `)            
          }
        }
    })
  })

  $(".edit-product-data").on("click", function() { 
    const product_id = $(this).closest('.table-body').find('.product_id').val()     
    $.ajax({
      type: "GET",
      url: `/admin/products/${product_id}`,
      dataType: "json",
      success: function({product, categories}){            
        $("#edit_product_form").attr("action", `/admin/products/${product_id}`)
        $("#edit_thumbnail_img").attr("src", `/uploads/products/thumbnails/${product.thumbnail_img}`)
        $("#edit_product_id").val(product.id)
        $("#edit_title").val(product.title)            
        $("#edit_price").val(product.price)
        $("#edit_stock").val(product.stock)
        editor2.setHTMLCode(product.description)
        
        categories.forEach(category => {
          if(category.id == product.product_category.id) {
            $("#edit_category_product").append(`
              <option value="${category.id}" selected>
                  ${category.name}
              </option>
          `)
          } else {
            $("#edit_category_product").append(`
              <option value="${category.id}">
                  ${category.name}
              </option>
          `)
          }
        });
                        
        $(".edit-multiple-preview-images").html('')
        for(let i = 0; i < product.product_images.length; i++) {
          $(".edit-multiple-preview-images").append(`
            <div class="col-3 mb-4 position-relative">
              <i class="bx bx-x position-absolute text-dark fa-lg delete-img-icon" data-id="${product.product_images[i].id}" style="right: 15px; cursor: pointer;"></i>
              <img src="/uploads/products/images/${product.product_images[i].image}" class="border" width="100%" alt="">
            </div>
          `)            
        }

        $(".delete-img-icon").on('click', function() {
          $(this).parent().remove()

          let oldValue = $(".image_deleted").val()
          let arr = oldValue === "" ? [] : oldValue.split(',');
          arr.push($(this).data('id'));
          let newValue = arr.join(',');

          $(".image_deleted").val(newValue)

          console.log($(".image_deleted").val())
        })
      }
    })
  })

  $(".delete-product-data").on("click", function() { 
    const product_id = $(this).closest('.table-body').find('.product_id').val()     
    $.ajax({
      type: "GET",
      url: `/admin/products/${product_id}`,
      dataType: "json",
      success: function({product}){            
        console.log(product)
        $("#delete_product_form").attr("action", `/admin/products/${product.id}`)
      }
    })
  })
})

previewImg("create-product-input", "create-product-preview-img")
previewImg("edit-product-input", "edit-product-preview-img")
previewMultipleImages("create-product-multiple-images", "multiple-preview-images")
previewMultipleImages("edit-product-multiple-images", "edit-multiple-preview-images-new")