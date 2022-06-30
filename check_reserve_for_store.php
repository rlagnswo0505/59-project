<script src="js/check_reserve_for_store.js"></script>
<script>
    
    const storeNum = '<?=isset($_SESSION['login_store']) ? $_SESSION['login_store']['store_num']:0 ?>';
    console.log(storeNum);
    check_reserve_for_store(storeNum);
    
</script>

<!-- 
예약주문 알림기능    
관리자로그인세션이 되어있는 페이지에 이파일은 Include하면됩니다  -->