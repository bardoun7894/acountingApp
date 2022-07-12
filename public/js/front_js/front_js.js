var localization;
$(document).on('click','.user',function (){
    $(".form").addClass('login-form-active');
})
$(document).on('click','.login-form-cancel',function (){
    $(".form").removeClass('login-form-active')
})
$(document).on('click','.sign-up-form-cancel',function (){
    $(".form").removeClass('sign-up-form-active')
})
$(document).on('click','.sign-up-btn',function (){
    $(".form").addClass('sign-up-form-active').removeClass('login-form-active')
});
$(document).on('click','.login-btn',function (){
    $(".form").addClass('login-form-active').removeClass('sign-up-form-active')
});
$(document).on( 'ready',function(){
    $("#adaptive").lightSlider({
       item:1,
       autoWidth: true,
    });

});

//for slider where screen is less than 768px
var width =  window.innerWidth;
$(document).on('ready', function(){

      localization= document.location.href.split("/")[3];
    $("#autoWidth").lightSlider({
       item:width<900?3:5,
    });
});
// for fix menu when scroll down and top
$(window).on('scroll', function(){
  if($(document).scrollTop() > 50) {
        $('.navigation').addClass('fix-nav');
    }else{
        $('.navigation').removeClass('fix-nav');
    }
});
// for responsive   menu
jQuery(function() {
    $(".toggle").on('click',function(){
        $(".toggle").toggleClass("active");
        $(".navigation").toggleClass("active");
    })

})

$(document).on('click','.search',function (){
    $(".search-bar").addClass('search-bar-active')
})
$(document).on('click','.search-cancel',function (){
    $(".search-bar").removeClass('search-bar-active')
})  ;
function getCountD(){
    var a="";
    var k= [];
    var input = document.getElementsByName('category_id[]');
    for (var i = 0; i < input.length; i++) {
       a = input[i].value;
       k.push(a);
    }
    $.ajax(
        {
            type:'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:'/'+localization+'/front/get_category_id',
            data:{k:k},
            success:function (resp) {
                // document.getElementsByClassName("count_products_small")
                // document.querySelector('.count_products_small').innerHTML=resp
                $(".count_products_small").html(resp);
                  console.log(resp+";;");

            },error:function (error) {
                console.info(error);
            }
        }
    );

}
$(document).on('ready',function () {
    //sort filter by urls
    // $('#sort').on('change',function (){
    //     this.form.submit();
    // })
    getCountD();
    $('#sort').on('change',function (){
        var sort =$(this).val();
        $.ajax(
            {
                type:'post',
                headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:'/'+localization+'/front/products',
                data:{sort:sort},
                success:function (resp) {
                    console.log(resp+"2")
                // $(".filter_products").html(resp);
                console.log(resp);
                },error:function (error) {
                   console.info(error);
                }
            }
        );
    })
    $('.block-co').on('ready',function (){
        var category_id =$(this).val();
        console.log(category_id);
        // $.ajax(
        //     {
        //         type:'post',
        //         headers: {
        //        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         url:'/'+localization+'/front/products',
        //         data:{sort:sort},
        //         success:function (resp) {
        //         $(".filter_products").html(resp);
        //         console.log(resp);
        //         },error:function (error) {
        //            console.info(error);
        //         }
        //     }
        // );
    })

} );

