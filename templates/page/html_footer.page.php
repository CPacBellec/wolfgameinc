<footer class="footer mt-3 py-3 bg-body-tertiary" <?php echo (isset($_GET['page']) && $_GET['page']==="adminRank"? "style='margin-left: 272px;'" : "") ;?>>
    <div class="container">
        <span class="text-body-secondary">
            Wolfgameinc 2023
        </span>
    </div>
</footer>
</body>
<script >
var dropdownCategory = document.getElementById("dropdownCategory");
dropdownCategory.addEventListener("click", function() {
var dropdownMenu = this.querySelector('.dropdown-menu');
if (dropdownMenu.style.display === "block") {
    dropdownMenu.style.display = "none";
} else {
    dropdownMenu.style.display = "block";
}
});

//dropdown profils
var dropdownProfils = document.getElementById("dropdownProfils");
dropdownProfils.addEventListener("click", function() {
var dropdownMenu = this.querySelector('.dropdown-menu');
if (dropdownMenu.style.display === "block") {
    dropdownMenu.style.display = "none";
} else {
    dropdownMenu.style.display = "block";
}
});


</script>

</html>