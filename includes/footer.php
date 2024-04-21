</div>
</div>
</div>
<script src="JavaScript/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="./DataTables/datatables.js"></script>

<script>
  let table = new DataTable('#myTable');

  $(".sidebar ul li").on('click', function() {
    $(".sidebar ul li.active").removeClass('active');
    $(this).addClass('active');
  });

  $('.open-btn').on('click', function() {
    $('.sidebar').addClass('active');

  });


  $('.close-btn').on('click', function() {
    $('.sidebar').removeClass('active');

  })
</script>
</body>

</html>