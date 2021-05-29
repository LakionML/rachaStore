
<!-- Footer -->
<footer class="py-5 bg-dark sticky-bottom">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="includes/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="includes/vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="includes/js/demo/datatables-demo.js"></script>

  <script type="text/javascript">
      $(document).ready(function(){
    
      load_cart_item_number();
      function load_cart_item_number(){
      $.ajax({
        url: 'action.php',
        method:'get',
        data:{cartItem:"cart_item"},
        success:function(response){

      $("#cart-item").html(response);   

        }
      })

      }

      });
</script>  


</body>

</html>