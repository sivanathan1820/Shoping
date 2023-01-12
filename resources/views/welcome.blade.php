<!DOCTYPE html>
<html lang="zxx">
   <head>
      <meta charset="UTF-8">
      <meta name="description" content="Ogani Template">
      <meta name="keywords" content="Ogani, unica, creative, html">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Dashboard</title>
      <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}" type="text/css">
      <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}" type="text/css">
      <link rel="stylesheet" href="{{asset('assets/css/elegant-icons.css')}}" type="text/css">
      <link rel="stylesheet" href="{{asset('assets/css/nice-select.css')}}" type="text/css">
      <link rel="stylesheet" href="{{asset('assets/css/jquery-ui.min.css')}}" type="text/css">
      <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}" type="text/css">
      <link rel="stylesheet" href="{{asset('assets/css/slicknav.min.css')}}" type="text/css">
      <link rel="stylesheet" href="{{asset('assets/css/style.css')}}" type="text/css">
      <style type="text/css">
         .nice-select
         {
            width: 100% !important;
            height: 50px !important;
            margin-top: 5px !important;
            border-radius: 0px !important;
         }
         .list
         {
            width: 100% !important;
         }
      </style>
   </head>
   <body>
      <div id="preloder">
         <div class="loader"></div>
      </div>
      <div class="humberger__menu__overlay"></div>
      <header class="header">
         <div class="container">
            <br>
            <div class="row">
               <div class="col-lg-3">
                  <div class="header__logo">
                     <a href="javascript:void(0)"><img src="{{asset('assets/img/logo.png')}}" alt=""></a>
                  </div>
               </div>
               <div class="col-lg-9">
                    <div class="row">
                       <div class="col-lg-3">
                          <select class="form-control" id="category" style="width:100%;">
                          </select>
                       </div>
                       <div class="col-lg-9 mt-1">
                          <div class="hero__search">
                             <div class="hero__search__form">
                                <form action="#">
                                   <input type="text" id="search" placeholder="What do yo u need?">
                                   <button type="button" onclick="ListItem()" class="site-btn">SEARCH</button>
                                </form>
                             </div>
                          </div>
                       </div>
                    </div>
                 </div>
            </div>
         </div>
      </header>
      <section class="featured spad">
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <div class="section-title">
                     <h2>Featured Product</h2>
                  </div>
               </div>
            </div>
            <div class="row featured__filter" id="itemslist">
               
            </div>
         </div>
      </section>
      <script src="{{asset('assets/js/jquery-3.3.1.min.js')}}"></script>
      <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
      <script src="{{asset('assets/js/jquery.nice-select.min.js')}}"></script>
      <script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
      <script src="{{asset('assets/js/jquery.slicknav.js')}}"></script>
      <script src="{{asset('assets/js/mixitup.min.js')}}"></script>
      <script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
      <script src="{{asset('assets/js/main.js')}}"></script>
      <script type="text/javascript">
         $(document).ready(function(){
            ListCategory();
         });
         let test = '';
         function ListCategory()
         {
            $.ajax({
               type: "POST",
               url: "{{url('api/list-categories')}}",
               dataType: 'json',
               success: function (msg) 
               {
                  test=msg;
                  if(msg.code==200)
                  {
                     var option = '<option value="">All Categories</option>';
                     if(msg.data.length>0)
                     {
                        for (var i = 0; i < msg.data.length; i++) 
                        {
                           option += '<option value="'+msg.data[i].id+'">'+msg.data[i].category+'</option>';
                        }
                     }
                     $("#category").html(option);
                     $("#category").niceSelect('update');
                     ListItem();
                  }
               },
               error: function (msg) 
               {
                  console.log(msg);
               }
            });
         }

         function ListItem()
         {
            var search     = $("#search").val();
            var category   = $("#category").val();

            $.ajax({
               type: "POST",
               url: "{{url('api/list-items')}}",
               data : {'search' : search,'category' : category},
               dataType: 'json',
               success: function (msg) 
               {
                  test=msg;
                  if(msg.code==200)
                  {
                     var path = '{{asset("assets/")}}/';
                     var data = '';
                     if(msg.data.length>0)
                     {
                        for (var i = 0; i < msg.data.length; i++) 
                        {
                           data += '<div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat"><div class="featured__item"><div align="center"><img src="'+path+msg.data[i].image+'" style="width: 10rem !important;"></div><div class="featured__item__text"><h6><a href="#">'+msg.data[i].item+'</a></h6><h5>'+msg.data[i].price+'</h5></div></div></div>';
                        }
                     }
                     $("#itemslist").html(data);
                  }
               },
               error: function (msg) 
               {
                  console.log(msg);
               }
            });
         }
      </script>
   </body>
</html>