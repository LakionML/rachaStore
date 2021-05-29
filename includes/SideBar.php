<div class="col-lg-3">

<h1 class="my-4"> </h1>
        <div class="list-group">
        <li class="list-group-item active" aria-disabled="true">Categories</li>
        <a href='shop.php' class='list-group-item'><b>ALL</b></a>
        <?php 
        //Listdown all the categories from DB  
require('./mysqli_connect.php');	
      $getcat="SELECT * FROM `categories`";
      $catrun=mysqli_query($dbc,$getcat);
      while ($rowCat=mysqli_fetch_assoc($catrun)) {
        $catid=$rowCat['category_id'];
        $catName=$rowCat['category_name'];
      echo"
     
      <a href='shop.php?catid=$catid' class='list-group-item'>$catName</a>
      ";
      }

      ?>
      


        
        </div>
        <div class="card mt-4">
        <li class="list-group-item active" aria-disabled="true">Price Range</li>
        <a href='shop.php?pfo=1&pto=50000' class='list-group-item'>All </a>
        <a href='shop.php?pfo=1&pto=50' class='list-group-item'>$1 To $50 </a>
        <a href='shop.php?pfo=51&pto=150' class='list-group-item'>$50 To $150 </a>
        <a href='shop.php?pfo=151&pto=300' class='list-group-item'>$150 To $300 </a>
        <a href='shop.php?pfo=351&pto=500' class='list-group-item'>$350 To $500 </a>
        <a href='shop.php?pfo=501&pto=1000' class='list-group-item'>$500 To $1000 </a>
</div>
</div>

