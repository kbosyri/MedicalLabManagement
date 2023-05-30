<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pdf</title>
</head>

<body>
  <style>
    body {
      margin: 0;
      padding: 0;
      box-sizing: border-box;

    }

    header {
      height: 17vh;
      margin-top: 20px;
      margin-left: -100px;
      border-bottom: 3px solid rgb(14, 17, 58);
    }

    img {
      width: 150px;
      height: 220px;
      margin-top: -70px;
      margin-left: 35%;

    }

    header #Pa_Info {
      position: absolute;
      text-align: center;
      font-size: 13px;
      top:-2px;
      left: 75%;
    }
    header #Lab_Info {
      position: absolute;
      text-align: center;
      font-size: 10px;
      left: 3%;
      top: 2%;
    }
    header #Test_Date {
      position: absolute;
      text-align: center;
      font-size: 20px;
      top:13%;
      left: 40%;
    }


    main {
      width: 90vw;
      margin: 0 auto;
      margin-top: 0px;
      margin-bottom: 20px;
      padding: 10px;
      min-height: calc(100vh - 178.69px - 154px);
    }

    main h1 {
      text-align: center;
      font-size: 15px;
      font-weight: bold;
      width: 50%;
      position: relative;
      left: 25%;
      margin-bottom: 20px;
      padding: 5px;
      border: 1px solid #ccc;
      border: 2px solid #b3b4c2;
      box-shadow: rgb(51, 52, 73) 1px 1px 1px 1px;
    }

    table {
      width: 100%;
      text-align: center;
      border: 2px solid #ccc;
      border-collapse: unset;
      border-spacing: 10px;

    }

    table thead td {
      font-weight: bold;
      border-bottom: 1px solid #ccc;
    }

    table td {
      padding: 5px 15px;

    }

    .testName {
      font-size: 23;
    }

    .cat {
      font-weight: bold;
      position: relative;
      left: -40px;
    }

    .sub {
      font-weight: bold;
      position: relative;
      left: 0px;
    }

    .result {
      background-color: #f3f2f2;
      border: 1px solid #ccc;
      border: 2px solid #b3b4c2;
      box-shadow: rgb(51, 52, 73) 1px 1px 1px 1px;
    }

    footer {
      border-top: 3px solid rgb(14, 17, 58);
      height: auto;
      color: rgb(5, 8, 56);
    }

    

    .footer-content h3 {
      font-size: 20px;
      text-transform: capitalize;
      line-height: 2rem;

    }

    .footer-content p {
      max-width: 200px;
      line-height: 0px;
    }
  </style>
  <div class="container-fluid">
    @if($values["web"])
      <header class="blog-header lh-1 py-3">
        <div class="row">

          <div id="Pa_Info" class="col">
            <h2>Name : {{$values['patient']['first_name']}}</h2>
            @if($values['patient']['gender'] == 'f')
            <h2>Gender : Female</h2>
            @else
            <h2>Gender : Male</h2>
            @endif
            <h2>Date : {{$values['date']}} </h2>
          </div>

          <div id="Lab_Info"  class="col">
            <h1>Habbas Medical Laboratory</h1>
            <h1>Dr.Ahmad Habbas</h1>
          </div>

          <div  >
            <h3 id="Test_Date"> Date : 2023-05-27</h3>
          </div>

        </div>
      </header>
    @endif


    <main>
      <h1>{{$values['test']['name']}}</h1>
      <table>
        <thead>
          <tr>
            <td>Tests</td>
            <td>Result</td>
            <td>Reference range</td>
            <td>Units</td>
          </tr>
        </thead>
        <tbody>
          @foreach($values['test']['elements'] as $main_element)
            @php
             error_log("Element");
             error_log("Is_Category: ".$main_element['is_category']);
            @endphp
            @if(!$main_element['is_category'])
              @php
                error_log("Not Category");
              @endphp
              <tr>
                <td class="testName">{{$main_element['name']}}</td>
                <td class="result">{{$main_element['test_value']}}</td>
                <td>8.5-10.5</td>
                <td>{{$main_element['test_unit']}}</td>
              </tr>
            @else
              @php
                error_log("Category")
              @endphp
              <tr>
                <td>
                  <hr>
                </td>
                <td>
                  <hr>
                </td>
                <td>
                  <hr>
                </td>
                <td>
                  <hr>
                </td>
              </tr>
              <tr>
                <td class="cat">{{$main_element['name']}}: </td>
              </tr>
            @foreach($main_element['values'] as $cat_elem)
              @php
                error_log('category_element:'.$cat_elem['name'])
              @endphp
              @if($cat_elem['is_subcategory'])
                <tr>
                  <td class="sub">- {{$cat_elem['name']}}: </td>
                </tr>
                @foreach($cat_elem['values'] as $subcat_elem)
                  <tr>
                    <td class="testName">{{$subcat_elem['name']}}</td>
                    <td class="result">{{$subcat_elem['test_value']}}</td>
                    <td>8.5-10.5</td>
                    <td>{{$subcat_elem['test_unit']}}</td>
                  </tr>
                @endforeach
              @else
                <tr>
                  <td class="testName">{{$cat_elem['name']}}</td>
                  <td class="result">{{$cat_elem['test_value']}}</td>
                  <td>8.5-10.5</td>
                  <td>{{$cat_elem['test_unit']}}</td>
                </tr>
              @endif
          @endforeach
            <tr>
              <td>
                <hr>
              </td>
              <td>
                <hr>
              </td>
              <td>
                <hr>
              </td>
              <td>
                <hr>
              </td>
            </tr>
          @endif
          @endforeach
          <!--<tr>
            <td class="testName">Calcium</td>
            <td class="result">10.5</td>
            <td>8.5-10.5</td>
            <td>mg/dl</td>
          </tr>
          <tr>
            <td>
              <hr>
            </td>
            <td>
              <hr>
            </td>
            <td>
              <hr>
            </td>
            <td>
              <hr>
            </td>
          </tr>
          <td class="cat">Total Protiens: </td>
          </tr>
          <tr>
            <td class="sub">- Total Protiens: </td>
          </tr>
          <tr>
            <td class="testName">Calcium </td>
            <td class="result">10.5</td>
            <td>8.5-10.5</td>
            <td>mg/dl</td>
          </tr>
          <tr>
            <td class="testName">phosphours </td>
            <td class="result">4.5</td>
            <td>2.5-4.5</td>
            <td>mg/dl</td>
          </tr>
          <tr>
            <td class="testName">PTH </td>
            <td class="result">35.0</td>
            <td>10-70</td>
            <td>pg/ml</td>
          </tr>
          <tr>
            <td class="testName">CRP </td>
            <td class="result">1.79</td>
            <td>up to 5.0</td>
            <td>mg/L</td>
          </tr>
          <tr>
          <tr>
            <td>
              <hr>
            </td>
            <td>
              <hr>
            </td>
            <td>
              <hr>
            </td>
            <td>
              <hr>
            </td>
          </tr>
          <td class="testName">PTH </td>
          <td class="result">35.0</td>
          <td>10-70</td>
          <td>pg/ml</td>
          </tr>
          <tr>
            <td class="testName">PTH </td>
            <td class="result">35.0</td>
            <td>10-70</td>
            <td>pg/ml</td>
          </tr>
          <tr>
            <td>
              <hr>
            </td>
            <td>
              <hr>
            </td>
            <td>
              <hr>
            </td>
            <td>
              <hr>
            </td>
          </tr>-->

        </tbody>
      </table>

    </main>

    <footer>
      <div class="footer-content">
        <h3>Syria,Rif Dimshq,Al-Tal</h3>
        <p>0947830277</p>
      </div>
    </footer>

</body>

</html>