<script>
	let sidebar_cur_mode_open = true;
	if (localStorage.getItem("sidebar_cur_mode_open") === null) {
		sidebar_cur_mode_open = true;

	} else {
		sidebar_cur_mode_open = JSON.parse(localStorage.getItem('sidebar_cur_mode_open'));
        console.log(sidebar_cur_mode_open);
		if(sidebar_cur_mode_open == false){
			closeSideBar();
		}else{
            openSidebar();
        }

	}

	function sidebarmode() {
		if (sidebar_cur_mode_open) {
			closeSideBar()
		} else {
			openSidebar();
		}
		localStorage.setItem("sidebar_cur_mode_open", sidebar_cur_mode_open);

	}

	function closeSideBar() {
		sidebar_cur_mode_open = false;
		$("#sidebar-nav").addClass('d-none');
		$("#main-side-bar-nav").css('width', '2%');
		$("#toggle-side-bar-nav").removeClass('fa-angle-double-left');
		$("#toggle-side-bar-nav").addClass('fa-angle-double-right');
		$("#main-content-template-admin").css('width', '100%');
	}

	function openSidebar() {
		sidebar_cur_mode_open = true;
		$("#sidebar-nav").removeClass('d-none');
		$("#main-side-bar-nav").css('width', '15%');
		$("#toggle-side-bar-nav").removeClass('fa-angle-double-right');
		$("#toggle-side-bar-nav").addClass('fa-angle-double-left');
		$("#main-content-template-admin").css('width', '80%');
	}
</script>