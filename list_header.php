<nav class="header--nav">
    <div class="nav--logo">
        <a href="javascript:history.back();" class="nav--back">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
    </div>
    <div class="nav--addr">
        <a href="my_addr.php" class="addr__link">
            <i class="fa-solid fa-location-dot"></i>
            <div class="user-addr"></div>
            <i class="fa-solid fa-angle-down"></i>
        </a>
    </div>
    <div class="nav--notice">
        <a href="not.php">
            <i class="fa-regular fa-bell"></i>
        </a>
    </div>
</nav>
<script>
    const userAddr = document.querySelector(".user-addr");
    const getAddr = localStorage.getItem('my_addr');
    const stringifyAddr = JSON.parse(getAddr);

    if (getAddr !== null) {
        userAddr.innerHTML = stringifyAddr['title'];
    } else {
        document.write('현재 위치 없음');
    }
</script>