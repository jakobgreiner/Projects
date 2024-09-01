<?php include 'inc/header.php'; ?>


<?php 
        include 'inc/functions.php';
        include 'inc/names.php';


$currentName = $_GET['name'];
$namesFiltered = [];

?>


<?php foreach($names AS $nameArray)

{

    if($nameArray['name'] !== $currentName)
    {
        continue;
    }
    
    $namesFiltered[] = $nameArray;
    
} 
?>

<?php if(!empty($namesFiltered)) :?>
            <h2> Geburtsstatistiken für <?php echo e($currentName); ?>: </h2>

            <?php 
                $chartYears = [];
                $chartCounts = [];
                foreach($namesFiltered AS $nameArray)
                {
                    $chartYears[] = $nameArray['year'];
                    $chartCounts[] = $nameArray['count'];
                }
            ?>


    <script type="text/javascript" src="scripts/chart.js"></script>
    <div>
    <canvas id="myChart"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'line',
            data: {
            labels: <?php echo json_encode($chartYears); ?>,
            datasets: [{
                label: '# of babies',
                data: <?php echo json_encode($chartCounts); ?>,
                borderWidth: 2,
                borderColor: 'rgb(75,192,192)',
            }]
            },
            options: {
            scales: {
                y: {
                beginAtZero: true
                }
            }
            }
        });
    </script>
        
    <table>
        <thead>
            <tr> 
                <th>Jahr</th>
                <th>Anzahl der Geburten </th>
            </tr>
        </thead>

        <tbody>
           <?php foreach($namesFiltered AS $nameArray):?>
                <tr>
                    <td> <?php echo $nameArray['year']; ?> </td>
                    <td> <?php echo $nameArray['count']; ?> </td>
                </tr>
           <?php endforeach;?>
        </tbody>
    </table>
<?php endif; ?>



<?php include 'inc/footer.php'; ?>