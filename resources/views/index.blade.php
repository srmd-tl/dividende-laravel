<!doctype html>
<html lang="en">
   <head>
      <title>Dividende</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="{{asset('css/style.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('css/style1.css')}}">
      <link rel="shortcut icon" type="image/png" href="{{asset('images/favicon.png')}}"/>

   </head>
   <body>
      <!-- ===================== top nabvar // start =========================== -->
      <section id="top_navbar">
         <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
              
               <a class="navbar-brand" href="{{route('index')}}"><img src="{{asset('images/logo.png')}}" alt=""></a>
               <button type="button" id="sidebarCollapse" class="btn btn-primary">
               <i class="fa fa-bars"></i>
               <span class="sr-only">Toggle Menu</span>
               </button>
               
               <div class="findUser desktop_view float-right">
                 <form method="GET" action="{{route('index')}}">
                    <input type="text" placeholder="Search" name="tickerOrName" value="">
                    <button type="submit" class="serch_btn"><i class="fa fa-search" aria-hidden="true"></i></button>
                 </form>
              </div>
              
            </nav>
         </div>
      </section>
      <!-- ===================== top nabvar // end =========================== -->
      <!-- ===================== contactOrSidebar // start =========================== -->
      <section id="contactOrSidebar">
         <div class="container">
          <div class="search_for_mobile">
            <div class="findUser">
                 <form method="GET" action="{{route('index')}}">
                    <input type="text" placeholder="Search" name="tickerOrName" value="">
                    <button type="submit" class="serch_btn"><i class="fa fa-search" aria-hidden="true"></i></button>
                 </form>
              </div>
          </div>
            <div class="wrapper d-flex ">
               <nav id="sidebar">
                  <form method="GET" action="{{route('index')}}" id="filterForm">
                     <div class="p-4 pt-5">
                        <div class="filer-detail">
                           <h3>filter</h3>
                           <div class="market">
                              <h2>market capitalization</h2>
                              <div class="market-form">
                                 
                                    <input class="text-center" type="text" placeholder="min" min="0" name="minMc" value="{{request()->minMc??0}}">
                                    <span>-</span>
                                    <input class="text-center" type="text" placeholder="max" name="maxMc" value="{{request()->maxMc}}">
                                
                              </div>
                           </div>
                           <div class="market">
                              <h2>P/E radio</h2>
                              <div class="market-form">
                                      <input class="text-center" type="text" placeholder="min" min="0" name="minPe" value="{{request()->minPe??0}}">
                                    <span>-</span>
                                    <input class="text-center" type="text"  placeholder="max" name="maxPe" value="{{request()->maxPe}}">
                                   
                              </div>
                           </div>
                           <div class="market">
                              <h2>Diviend Yield (%)</h2>
                              <div class="market-form">
                                  <input class="text-center" type="text" placeholder="min" min="0" name="minDy"  value="{{request()->minDy??0}}">
                                    <span>-</span>
                                    <input class="text-center" type="text"  placeholder="max" name="maxDy"  value="{{request()->maxDy}}">
                               
                              </div>
                           </div>
                              <h2>Sector</h2>

                              <label class="radioStyle">
                                 <span>All</span>
                                    <span class="countar">{{$totalCount}}</span>
                              <input type="radio" checked="checked" name="sector" value="all">

                              
                              <span class="checkmark"></span>
                              </label>
                              @forelse($sectorsAndCount as $sector)
                              <label class="radioStyle">
                                 <span>{{$sector->sector}}</span> 
                                 <span class="countar">{{$sector->count}}</span>
                              <input type="radio" {{request()->sector==$sector->sector ?'checked':''}}   name="sector" value="{{$sector->sector}}">
                              <span class="checkmark"></span>
                              </label>
                              @empty
                              @endforelse
                              
                            <!--   <label class="radioStyle">
                                 <span>Other</span> 
                                 <span class="countar">20</span>
                              <input type="radio"  {{request()->sector=='Other'?'checked':''}}  name="sector" value="Other">
                              <span class="checkmark"></span>
                              </label> -->
                           <div class="market country_select">
                              <h2>Country</h2>
                           <!-- <form action="{{route('index')}}" class="market" method="GET" id="countryForm"> -->
                              <label class="radioStyle"><span>France</span>
                              <input type="radio" checked="checked" name="country" value="France">
                              <span class="checkmark"></span>
                              </label>
                              <label class="radioStyle"><span>United States</span>
                              <input type="radio" {{request()->country=='USA'?'checked':''}}  name="country" value="USA">
                              <span class="checkmark"></span>
                              </label>
                              <label class="radioStyle"><span>United Kingdom</span>
                              <input type="radio" {{request()->country=='UK'?'checked':''}}  name="country" value="UK">
                              <span class="checkmark"></span>
                              </label>
                              <label class="radioStyle"><span>Germany</span>
                              <input type="radio" {{request()->country=='Germany'?'checked':''}}  name="country" value="Germany">
                              <span class="checkmark"></span>
                              </label>
                           <!-- </form> -->
                           </div>
                        </div>
                     </div>
                  </form>
               </nav>
               <!-- Page Content  -->
               <div id="content" >
                  <div class="content_title">
                    <h3>Results <span>{{$symbolFundamentals->total()}} total</span></h3>
                    <!-- <div class="button_nxt_pre">
                      <a href="#">Preview</a>
                      <a href="#">Next</a>
                    </div> -->
                  </div>
                  <div class="table-recponsives">
                     <table>
                        <tbody>
                           <tr class="row100 head">
                              <th class="cell100 column1">
                                 Name
                              </th>
                              <th class="column3"><a href="{{route('index',['mcOrder'=>request()->mcOrder=='up'?'down':'up',
                                'country'=>request()->country,
                                'sector'=>request()->sector,
                                'minMc'=>request()->minMc,
                                'maxMc'=>request()->maxMc,
                                'minPe'=>request()->minPe,
                                'maxPe'=>request()->maxPe,
                                'minDy'=>request()->minDy,
                                'maxDy'=>request()->maxDy])}}">


                                 <i class="fa fa-caret-{{request()->mcOrder=='up'?'up':'down'}}" aria-hidden="true"></i>


                                  Market Cap

                                 </a>
                              </th>


                              <th class="column3"><a href="{{route('index',['dyOrder'=>request()->dyOrder=='up'?'down':'up',
                                'country'=>request()->country,
                                'sector'=>request()->sector,
                                'minMc'=>request()->minMc,
                                'maxMc'=>request()->maxMc,
                                'minPe'=>request()->minPe,
                                'maxPe'=>request()->maxPe,
                                'minDy'=>request()->minDy,
                                'maxDy'=>request()->maxDy])}}">


                              <i class="fa fa-caret-{{request()->dyOrder=='up'?'up':'down'}}" aria-hidden="true"></i>
                                  Div. Yield

                           </a></th>


                              <th class="column4">Price History</th>
                              <!-- <th class="column5 color1">1Y 2Y 3Y</th> -->


                              <th class="column3"><a href="{{route('index',['peOrder'=>request()->peOrder=='up'?'down':'up',
                                'country'=>request()->country,
                                'sector'=>request()->sector,
                                'minMc'=>request()->minMc,
                                'maxMc'=>request()->maxMc,
                                'minPe'=>request()->minPe,
                                'maxPe'=>request()->maxPe,
                                'minDy'=>request()->minDy,
                                'maxDy'=>request()->maxDy])}}" aria-hidden="true">


                             <i class="fa fa-caret-{{request()->peOrder=='up'?'up':'down'}}" aria-hidden="true"></i>

                           P/E Radio</a></th>
                           </tr>
                           @forelse($symbolFundamentals as $fundamental)

                           <tr class="row100 body">
                              <td class="cell100 column1">
                                 <form action="">
                                    <div class="companyDetail">
                                       @if(!isset($fundamental->symbol->logo)||$fundamental->symbol->logo==env('APP_URL'))
                                       <img src="{{asset('images/nologo.png')}}" alt="icon">
                                       @else
                                       <img src="{{$fundamental->symbol->logo}}" alt="icon">
                                       @endif

                                       
                                       <div class="companyInfo">
                                          <h4>{{$fundamental->symbol->Code}}</h4>
                                          <p class="add-three-dots">{{Str::of($fundamental->symbol->Name)->limit(25)}}</p>
                                       </div>
                                    </div>
                                 </form>
                              </td>
                              <td class="column2">{{$fundamental->market_cap}}</td>
                              <td class="column3">{{$fundamental->dividend_yield}}</td>
                              <td class="column4">
                                 <img src="images/graph.png" alt="">
                              </td>
                              <!-- <td class="column5 color2"><i class="fa fa-caret-up" aria-hidden="true"></i>10.79%</td> -->
                              <td class="column6">
                                 <div class="">
                                    <span>{{$fundamental->pe_ratio}}</span>
                                  <!--   <div class="dots_color">
                                       <i class="fa fa-circle check-color" aria-hidden="true"></i>
                                       <i class="fa fa-circle check-color" aria-hidden="true"></i>
                                       <i class="fa fa-circle check-color" aria-hidden="true"></i>
                                       <i class="fa fa-circle check-color" aria-hidden="true"></i>
                                       <i class="fa fa-circle" aria-hidden="true"></i>
                                    </div> -->
                                 </div>
                              </td>
                           </tr> 
                           @empty
                           <tr><td>NOthing FOund!</td></tr>
                           @endforelse
                          

                        </tbody>
                        <tfoot>
                           <tr>
                              <td>
                                 {{$symbolFundamentals->withQueryString()->links()}}
                              </td>
                           </tr>
                        </tfoot>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- ===================== contactOrSidebar // end =========================== -->
      <script src="{{asset('js/jquery.min.js')}}"></script>
      <script src="{{asset('js/popper.js')}}"></script>
      <script src="{{asset('js/bootstrap.min.js')}}"></script>
      <script src="{{asset('js/main.js')}}"></script>
      <script type="text/javascript">
         $(function(){
            /*On change Country Filter*/
            $('input[name="country"]').change(function(){

               $("#countryForm").submit()
            });

            /*End Country Filter*/

            /*On chage Min  Market Cap filter*/
            $("input[name='minMc'],input[name='maxMc'],input[name='maxPe'],input[name='minPe'],input[name='minDy'],input[name='maxDy'],input[name='sector'],input[name='country']").change(function(){

               $("#filterForm").submit()

            });
            /*End On chage Min  Market Cap filter*/



      
         })
      </script>
   </body>
</html>