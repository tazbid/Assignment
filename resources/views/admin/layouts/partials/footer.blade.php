<footer class="main-footer">
  {{-- <strong>Copyright &copy; <span id="footer-year"></span> <a href="https://coderslab.com.bd/">Coders Lab</a>.</strong> --}}
  <div class="float-right d-none d-sm-inline-block">
  </div>
</footer>
<script>
  $(document).ready(() => {
      $("#footer-year").text(new Date().getFullYear());
  });
</script>
