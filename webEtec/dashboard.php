<?php
include('cabecalho.php');
include('menu.php');

include("conexao.php");

            $query = $pdo->prepare("select count(y.idProduto), x.categoria from tbProduto y
            inner join tbCategoria x
            on y.idCategoria = x.idCategoria
            group by categoria");
            
            $query->execute();
        ?>
            
         



<html>
  <head>
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    

      // Load Charts and the corechart package.

      google.charts.load('current', {'packages':['corechart']});

      // Draw the pie chart for Sarah's pizza when Charts is loaded.
      google.charts.setOnLoadCallback(drawSarahChart);

      // Draw the pie chart for the Anthony's pizza when Charts is loaded.
      google.charts.setOnLoadCallback(drawAnthonyChart);

      // Callback that draws the pie chart for Sarah's pizza.
      function drawSarahChart() {

        // Create the data table for Sarah's pizza.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Produtos');
        data.addRows([

          <?php
        while ($rows = $query->fetch(PDO::FETCH_BOTH)) {?>

          [<?php echo "'$rows[1]'" ?>, <?php echo $rows[0] ?>],
        
      <?php }
        
        ?>
        ]);

        // Set options for Sarah's pie chart.
        var options = {title:'Categoria',
                       width:815,
                       height:300,
                       colors: ['#30FDFF'],is3D:true};

        // Instantiate and draw the chart for Sarah's pizza.
        var chart = new google.visualization.BarChart(document.getElementById('Sarah_chart_div'));
        chart.draw(data, options);
      }

      // Callback that draws the pie chart for Anthony's pizza.
      function drawAnthonyChart() {

        // Create the data table for Anthony's pizza.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slic');
        data.addRows([
          ['Mushrooms', 2],
          ['Onions', 2],
          ['Olives', 2],
          ['Zucchini', 0],
          ['Pepperoni', 3]
        ]);

        // Set options for Anthony's pie chart.
        var options = {title:'Produto',
                       width:455,
                       height:300,
                       colors:['#337780', '#B3F6FF', '#52BECC', '#27C9CC'],is3D:true };

        // Instantiate and draw the chart for Anthony's pizza.
        var chart = new google.visualization.PieChart(document.getElementById('Anthony_chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    
  <div class="container centro">
    <!--Table and divs that hold the pie charts-->
    <table class="columns">
      <tr>
        <td><div id="Sarah_chart_div" style="border: 1px solid #ccc" class="grafico1"></div></td>
        <td><div id="Anthony_chart_div" style="border: 1px solid #ccc"></div></td>
      </tr>
    </table>
    </div>

      


  </body> 
</html>
            

       
<?php include("rodape.php")  ?>