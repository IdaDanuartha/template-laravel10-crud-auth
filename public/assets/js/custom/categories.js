$(document).ready(function() {
  $(".detail-category-data").on("click", function() {          
    $.ajax({
        type: "GET",
        url: `/admin/categories/${$(this).closest('.table-body').find('.category_id').val()}`,              
        dataType: "json",
        success: function({category}){    
          $("#detail-name").val(category.name)
        }
    })
  })

  $(".edit-category-data").on("click", function() { 
    const category_id = $(this).closest('.table-body').find('.category_id').val()     
    $.ajax({
      type: "GET",
      url: `/admin/categories/${category_id}`,
      dataType: "json",
      success: function({category}){    
        $("#edit_category_form").attr("action", `/admin/categories/${category.id}`)      
        $("#edit_category_id").val(category.id)    
        $("#edit-name").val(category.name)
      }
    })
  })

  $(".delete-category-data").on("click", function() { 
    const category_id = $(this).closest('.table-body').find('.category_id').val()     
    $.ajax({
      type: "GET",
      url: `/admin/categories/${category_id}`,
      dataType: "json",
      success: function({category}){            
        console.log(category)
        $("#delete_category_form").attr("action", `/admin/categories/${category.id}`)
      }
    })
  })
})