<link rel="stylesheet" href="css/codemirror.css">

<?php
/*
 * Regenerate HTML Templates
 */
if (isset($_GET['type']) && isset($_GET['regenhtml']) && ($_GET['type'] == 'layout') && ($_GET['regenhtml'] == '1')) {

    echo '<div class="alert alert-info">Blog post template regeneration started. Please do not close this window or refresh until it shows success message.</div>';

    $status = $blog->regen_templates();

    if ($status) {
        $redurl = admin_url('admin.php?action=manage&type=layout&regenhtml=3');
        redirect_script($redurl);
    }
}

if (isset($_GET['regenhtml']) && ($_GET['regenhtml'] == '3')) {
    echo '<div class="alert alert-success">Blog templates has been generated successfully.</div>';
}
//Restore Default
if (isset($_GET['reset_default'])) {
    //header
    if ($_GET['reset_default'] == 'header') {
        $sHeaderBackup = 'PCFET0NUWVBFIGh0bWw+Cgo8aHRtbD4KCiAgICA8aGVhZD4KCiAgICAgICAgPCEtLSBSZXF1aXJlZCBtZXRhIHRhZ3MgLS0+CiAgICAgICAgPG1ldGEgY2hhcnNldD0idXRmLTgiPgogICAgICAgIDxtZXRhIG5hbWU9InZpZXdwb3J0IiBjb250ZW50PSJ3aWR0aD1kZXZpY2Utd2lkdGgsIGluaXRpYWwtc2NhbGU9MSwgc2hyaW5rLXRvLWZpdD1ubyI+CgogICAgICAgIDx0aXRsZT5CbG9nIHwgPD9waHAgZWNobyAkYmxvZ190aXRsZTsgPz48L3RpdGxlPgoKICAgICAgICA8P3BocCBpZiAoJGJsb2dpbmZvLT5zZWFyY2hfZW5naW5lX3Zpc2liaWxpdHkgPT0gMCkgeyA/PgogICAgICAgICAgICA8bWV0YSBuYW1lPSJyb2JvdHMiIGNvbnRlbnQ9Im5vaW5kZXgiIC8+CiAgICAgICAgPD9waHAgfSA/PgoKICAgICAgICA8bWV0YSBuYW1lPSJ0aXRsZSIgY29udGVudD0iPD9waHAgZWNobyAkbWV0YV90aXRsZTsgPz4iPgogICAgICAgIDxtZXRhIG5hbWU9ImRlc2NyaXB0aW9uIiBjb250ZW50PSI8P3BocCBlY2hvICRtZXRhX2Rlc2M7ID8+Ij4KICAgICAgICA8bWV0YSBuYW1lPSJhdXRob3IiIGNvbnRlbnQ9Ijw/cGhwIGVjaG8gJG1ldGFfYXV0aG9yOyA/PiI+CgogICAgICAgIDxsaW5rIHJlbD0ic2hvcnRjdXQgaWNvbiIgdHlwZT0iaW1hZ2UvanBlZyIgaHJlZj0iPD9waHAgZWNobyBzaXRlX3VybCgnaW1hZ2VzL2xvZ28ucG5nJyk7ID8+Ii8+CgogICAgICAgIDwhLS1Gb250cy0tPgogICAgICAgIDxsaW5rIGhyZWY9Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0OjQwMCw1MDAsNzAwIiByZWw9InN0eWxlc2hlZXQiPgoKICAgICAgICA8IS0tIENTUyBGaWxlcyAtLT4KICAgICAgICA8bGluayB0eXBlPSJ0ZXh0L2NzcyIgaHJlZj0iPD9waHAgZWNobyBhZG1pbl91cmwoJ2Nzcy9ib290c3RyYXAubWluLmNzcycpOyA/PiIgcmVsPSJzdHlsZXNoZWV0IiAvPgogICAgICAgIDxsaW5rIHR5cGU9InRleHQvY3NzIiBocmVmPSI8P3BocCBlY2hvIGFkbWluX3VybCgnY3NzL2ZvbnRhd2Vzb21lLWFsbC5taW4uY3NzJyk7ID8+IiByZWw9InN0eWxlc2hlZXQiIC8+CiAgICAgICAgPGxpbmsgdHlwZT0idGV4dC9jc3MiIGhyZWY9Ijw/cGhwIGVjaG8gc2l0ZV91cmwoJ3N0eWxlLmNzcycpOyA/PiIgcmVsPSJzdHlsZXNoZWV0IiAvPgoKICAgICAgICA8IS0tIFlvdSBjYW4gdXNlIE9wZW4gR3JhcGggdGFncyB0byBjdXN0b21pemUgbGluayBwcmV2aWV3cy4gLS0+CiAgICAgICAgPG1ldGEgcHJvcGVydHk9Im9nOnVybCIgICAgICAgICAgIGNvbnRlbnQ9Ijw/cGhwIGVjaG8gc2l0ZV91cmwoJGN1c3RvbV9ibG9nX3VybCk7ID8+IiAvPgogICAgICAgIDxtZXRhIHByb3BlcnR5PSJvZzp0eXBlIiAgICAgICAgICBjb250ZW50PSJ3ZWJzaXRlIiAvPgogICAgICAgIDxtZXRhIHByb3BlcnR5PSJvZzp0aXRsZSIgICAgICAgICBjb250ZW50PSI8P3BocCBlY2hvICRibG9nX3RpdGxlOyA/PiIgLz4KICAgICAgICA8bWV0YSBwcm9wZXJ0eT0ib2c6ZGVzY3JpcHRpb24iICAgY29udGVudD0iPD9waHAgZWNobyBzdHJpcF90YWdzKCRnZW5lcmF0ZWRodG1sKTsgPz4iIC8+CiAgICAgICAgPG1ldGEgcHJvcGVydHk9Im9nOmltYWdlIiAgICAgICAgIGNvbnRlbnQ9Ijw/cGhwIGVjaG8gKCRibG9nX2ZlYXR1cmVkX2ltYWdlID8gdXBsb2FkX3VybCgkYmxvZ19mZWF0dXJlZF9pbWFnZSkgOiAnJyk7ID8+IiAvPgoKICAgIDwvaGVhZD4KCiAgICA8IS0tIEJvZHkgU3RhcnQgLS0+CiAgICA8Ym9keT4KCiAgICAgICAgPCEtLSBIZWFkZXIgU3R5bGUxIFN0YXJ0IC0tPgogICAgICAgIDxoZWFkZXIgY2xhc3M9ImhlYWRlcl9kZXNpZ24xIHN0eWxlMSI+CiAgICAgICAgICAgIDxkaXYgY2xhc3M9ImNvbnRhaW5lciI+CiAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzPSJyb3ciPgogICAgICAgICAgICAgICAgICAgIDxkaXYgY2xhc3M9ImNvbC0xMiBjb2wtbWQtMiI+CiAgICAgICAgICAgICAgICAgICAgICAgIDxkaXYgY2xhc3M9ImxvZ29fd3IiPgogICAgICAgICAgICAgICAgICAgICAgICAgICAgPGEgaHJlZj0iPD9waHAgZWNobyBzaXRlX3VybCgpOyA/PiI+PGltZyBjbGFzcz0iaW1nLWZsdWlkIiBzcmM9Ijw/cGhwIGVjaG8gc2l0ZV91cmwoJ2ltYWdlcy9sb2dvLnBuZycpOyA/PiIgYWx0PSJXZWJzaXRlIExvZ28iIC8+PC9hPgogICAgICAgICAgICAgICAgICAgICAgICA8L2Rpdj4KICAgICAgICAgICAgICAgICAgICA8L2Rpdj4KICAgICAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzPSJjb2wtMTIgY29sLW1kLTEwIj4KICAgICAgICAgICAgICAgICAgICAgICAgPG5hdiBjbGFzcz0ibmF2YmFyIG5hdmJhci1leHBhbmQtbGciPgogICAgICAgICAgICAgICAgICAgICAgICAgICAgPGJ1dHRvbiBjbGFzcz0ibmF2YmFyLXRvZ2dsZXIiIHR5cGU9ImJ1dHRvbiIgZGF0YS10b2dnbGU9ImNvbGxhcHNlIiBkYXRhLXRhcmdldD0iI25hdmJhclN1cHBvcnRlZENvbnRlbnQiIGFyaWEtY29udHJvbHM9Im5hdmJhclN1cHBvcnRlZENvbnRlbnQiIGFyaWEtZXhwYW5kZWQ9ImZhbHNlIiBhcmlhLWxhYmVsPSJUb2dnbGUgbmF2aWdhdGlvbiI+CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPHNwYW4gY2xhc3M9Im5hdmJhci10b2dnbGVyLWljb24iPjwvc3Bhbj4KICAgICAgICAgICAgICAgICAgICAgICAgICAgIDwvYnV0dG9uPgoKICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxkaXYgY2xhc3M9ImNvbGxhcHNlIG5hdmJhci1jb2xsYXBzZSIgaWQ9Im5hdmJhclN1cHBvcnRlZENvbnRlbnQiPgogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDx1bCBjbGFzcz0ibmF2YmFyLW5hdiBtbC1hdXRvIj4KICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPGxpIGNsYXNzPSJuYXYtaXRlbSBhY3RpdmUiPgogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPGEgY2xhc3M9Im5hdi1saW5rIiBocmVmPSI8P3BocCBlY2hvIHNpdGVfdXJsKCk7ID8+Ij5CbG9nPC9hPgogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8L2xpPgogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8bGkgY2xhc3M9Im5hdi1pdGVtICI+CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8YSBjbGFzcz0ibmF2LWxpbmsiIGhyZWY9Ijw/cGhwIGVjaG8gc2l0ZV91cmwoJyNjb250YWN0Jyk7ID8+Ij5Db250YWN0PC9hPgogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8L2xpPgogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDwvdWw+CiAgICAgICAgICAgICAgICAgICAgICAgICAgICA8L2Rpdj4KICAgICAgICAgICAgICAgICAgICAgICAgPC9uYXY+CiAgICAgICAgICAgICAgICAgICAgPC9kaXY+CiAgICAgICAgICAgICAgICA8L2Rpdj4KICAgICAgICAgICAgPC9kaXY+CiAgICAgICAgPC9oZWFkZXI+CiAgICAgICAgPCEtLSBIZWFkZXIgU3R5bGUxIEVuZCAtLT4=';
        file_put_contents(SYSTEMPATH . '/blog_header.php', base64_decode($sHeaderBackup));
        $bStatus = 1;
    } else if ($_GET['reset_default'] == 'footer') {
        $sFooterBackup = 'PD9waHAgLy9CbG9nIEluZm9ybWF0aW9ucyAKJGJsb2dpbmZvID0gYmxvZ19pbmZvKCk7Cj8+CgogPCEtLSBGb290ZXIgIC0tPgo8c2VjdGlvbiBpZD0iZm9vdGVyIiBjbGFzcz0iZm9vdGVyX3NlY3Rpb24iPgogICAgPGRpdiBjbGFzcz0iY29udGFpbmVyIj4gCiAgICAgICAgPGRpdiBjbGFzcz0icm93Ij4KICAgICAgICAgICAgPGRpdiBjbGFzcz0iY29sLTEyIGNvbC1tZC00IGZvb3Rlcl93aWRnZXQiPgogICAgICAgICAgICAgICAgPGRpdiBjbGFzcz0iZm9vdGVyX2luZm8iPgogICAgICAgICAgICAgICAgICAgIDxkaXYgY2xhc3M9IndpZGdldC1mb290ZXIiPgogICAgICAgICAgICAgICAgICAgICAgICA8aDM+QWJvdXQ8L2gzPgogICAgICAgICAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzPSJ3aWRnZXQtdGV4dCI+CQkJCiAgICAgICAgICAgICAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzPSJ0ZXh0d2lkZ2V0Ij4KICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8cD48YSBocmVmPSIjIj5UZXN0PC9hPiBpcyBhIGZhc3QgZ3Jvd2luZyBvbmxpbmUgUmVhbCBFc3RhdGUgZmlybSB0aGF0IGZ1bmN0aW9ucyBvbiB0aGUgcHJpbmNpcGFscyBvZiB0cnVzdCwgdHJhbnNwYXJlbmN5IGFuZCBleHBlcnRpc2UuIFdlIGhhdmUgd2lkZSByYW5nZSBvZiB2ZXJpZmllZCBwcm9wZXJ0eSBsaXN0aW5ncyBhY3Jvc3MgdGhlIFB1bmUgdG8gbWVldCB0aGUgZ3Jvd2luZyBkZW1hbmQgb2YgaG9tZSBidXllcnMuPC9wPgogICAgICAgICAgICAgICAgICAgICAgICAgICAgPC9kaXY+CiAgICAgICAgICAgICAgICAgICAgICAgIDwvZGl2PgogICAgICAgICAgICAgICAgICAgIDwvZGl2PgkKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICA8L2Rpdj4KICAgICAgICAgICAgIDwvZGl2PgogICAgICAgICAgICAgICA8ZGl2IGNsYXNzPSJjb2wtMTIgY29sLW1kLTQgZm9vdGVyX3dpZGdldCI+CiAgICAgICAgICAgICAgICAgICAgPGRpdiBjbGFzcz0iZm9vdGVyX2luZm8iPgogICAgICAgICAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzPSJ3aWRnZXQtZm9vdGVyIj4KICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxoMz5Vc2VmdWwgTGlua3M8L2gzPgogICAgICAgICAgICAgICAgICAgICAgICAgICAgPGRpdiBjbGFzcz0id2lkZ2V0LXRleHQiPgogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxkaXYgY2xhc3M9Im1lbnUtZm9vdGVyLW1lbnVzLWNvbnRhaW5lciI+CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDx1bCBpZD0ibWVudS1mb290ZXItbWVudXMiIGNsYXNzPSJtZW51Ij4KICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxsaSBpZD0ibWVudS1pdGVtLTM5IiBjbGFzcz0ibWVudS1pdGVtIG1lbnUtaXRlbS10eXBlLXBvc3RfdHlwZSBtZW51LWl0ZW0tb2JqZWN0LXBhZ2UgbWVudS1pdGVtLWhvbWUgY3VycmVudC1tZW51LWl0ZW0gcGFnZV9pdGVtIHBhZ2UtaXRlbS0xNCBjdXJyZW50X3BhZ2VfaXRlbSBtZW51LWl0ZW0tMzkiPjxhIGhyZWY9IiMiPkhvbWU8L2E+PC9saT4KICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxsaSBpZD0ibWVudS1pdGVtLTQwIiBjbGFzcz0ibWVudS1pdGVtIG1lbnUtaXRlbS10eXBlLXBvc3RfdHlwZSBtZW51LWl0ZW0tb2JqZWN0LXBhZ2UgbWVudS1pdGVtLTQwIj48YSBocmVmPSIjYWJvdXQtdXMvIj5BYm91dCBVczwvYT48L2xpPgogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPGxpIGlkPSJtZW51LWl0ZW0tMzgiIGNsYXNzPSJtZW51LWl0ZW0gbWVudS1pdGVtLXR5cGUtcG9zdF90eXBlIG1lbnUtaXRlbS1vYmplY3QtcGFnZSBtZW51LWl0ZW0tMzgiPjxhIGhyZWY9IiNjb250YWN0LXVzLyI+Q29udGFjdCBVczwvYT48L2xpPgogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPGxpIGlkPSJtZW51LWl0ZW0tMzciIGNsYXNzPSJtZW51LWl0ZW0gbWVudS1pdGVtLXR5cGUtcG9zdF90eXBlIG1lbnUtaXRlbS1vYmplY3QtcGFnZSBtZW51LWl0ZW0tMzciPjxhIGhyZWY9IiNidXllcnMtZ3VpZGUvIj5CdXllcnMgR3VpZGU8L2E+PC9saT4KICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPC91bD4KICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8L2Rpdj4KICAgICAgICAgICAgICAgICAgICAgICAgICAgIDwvZGl2PgogICAgICAgICAgICAgICAgICAgICAgICA8L2Rpdj4JCiAgICAgICAgICAgICAgICAgICAgPC9kaXY+CiAgICAgICAgICAgICAgICA8L2Rpdj4KICAgICAgICAgICAgICAgIDxkaXYgY2xhc3M9ImNvbC0xMiBjb2wtbWQtNCBmb290ZXJfd2lkZ2V0X3NlY3Rpb24iPgogICAgICAgICAgICAgICAgPGRpdiBjbGFzcz0iZm9vdGVyX2luZm8iPgogICAgICAgICAgICAgICAgICAgIDxkaXYgY2xhc3M9IndpZGdldC1mb290ZXIiPgogICAgICAgICAgICAgICAgICAgICAgICA8aDM+Q29udGFjdCBJbmZvcm1hdGlvbjwvaDM+CiAgICAgICAgICAgICAgICAgICAgICAgIDxkaXYgY2xhc3M9IndpZGdldC10ZXh0Ij4JCQkKICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxkaXYgY2xhc3M9InRleHR3aWRnZXQiPiAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPHVsIGNsYXNzPSJjb250YWN0X2luZm9fZm9vdGVyIj4KICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPGxpPiAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxhIGhyZWY9Im1haWx0bzpzYWxlc0BleGFtcGxlLmNvbSI+IDxpIGNsYXNzPSJmYXMgZmEtZW52ZWxvcGUiPjwvaT4gc2FsZXNAZXhhbXBsZS5jb208L2E+CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDwvbGk+ICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPGxpPgogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPGEgaHJlZj0idGVsOjQ1MzQ1NDU0Ij48aSBjbGFzcz0iZmFzIGZhLW1vYmlsZS1hbHQiPjwvaT4wMzAzOTkzOTkzPC9hPiAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDwvbGk+CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxsaT4KICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxpIGNsYXNzPSJmYXMgZmEtbWFwLW1hcmtlci1hbHQiPjwvaT4gQWRkcmVzcyAgLSA0MTEwNjEgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPC9saT4KICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDwvdWw+CiAgICAgICAgICAgICAgICAgICAgICAgICAgICA8L2Rpdj4KICAgICAgICAgICAgICAgICAgICAgICAgPC9kaXY+CiAgICAgICAgICAgICAgICAgICAgPC9kaXY+CQogICAgICAgICAgICAgICAgPC9kaXY+CiAgICAgICAgICAgIDwvZGl2PgogICAgICAgIDwvZGl2PgogICAgIDwvZGl2PiAgICAgICAgICAgICAgIAo8L3NlY3Rpb24+CjxzZWN0aW9uIGlkPSJmb290ZXIyIiBjbGFzcz0iZm9vdGVyXzIiPgogICAgPGRpdiBjbGFzcz0iY29udGFpbmVyIj4KICAgICAgICA8ZGl2IGNsYXNzPSJyb3ciPgogICAgICAgICAgICA8ZGl2IGNsYXNzPSJjb2wtbGctNCBjb2wtbWQtNCBjb2wtMTIgY29sLXNtLTEyIHRleHQtbGVmdCI+CiAgICAgICAgICAgICAgICA8IS0tIHNvY2lhbCBpY29uLS0+IAogICAgICAgICAgICAgICAgPGRpdiBjbGFzcz0ic29jaWFsX2xpbmtzIj4gCiAgICAgICAgICAgICAgICAgICAgPGEgaHJlZj0iPD9waHAgZWNobyAkYmxvZ2luZm8tPmJsb2dfZmJfdXJsOyA/PiIgdGFyZ2V0PSJfYmxhbmsiPjxpIGNsYXNzPSJmYWIgZmEtZmFjZWJvb2stZiI+PC9pPjwvYT4KICAgICAgICAgICAgICAgICAgICA8YSBocmVmPSI8P3BocCBlY2hvICRibG9naW5mby0+YmxvZ19pbnN0YV91cmw7ID8+IiB0YXJnZXQ9Il9ibGFuayI+PGkgY2xhc3M9ImZhYiBmYS1pbnN0YWdyYW0iPjwvaT48L2E+CiAgICAgICAgICAgICAgICAgICAgPGEgaHJlZj0iPD9waHAgZWNobyAkYmxvZ2luZm8tPmJsb2dfdHdpdHRlcl91cmw7ID8+IiB0YXJnZXQ9Il9ibGFuayI+PGkgY2xhc3M9ImZhYiBmYS10d2l0dGVyIj48L2k+PC9hPgogICAgICAgICAgICAgICAgPC9kaXY+ICAgICAKICAgICAgICAgICAgPC9kaXY+CiAgICAgICAgICAgIDxkaXYgY2xhc3M9ImNvbC1sZy00IGNvbC1tZC00IGNvbC0xMiBjb2wtc20tMTIgdGV4dC1jZW50ZXIiPkNvcHlyaWdodCDCqSAyMDE4LiBBbGwgcmlnaHRzIHJlc2VydmVkLjwvZGl2PgogICAgICAgICAgICA8ZGl2IGNsYXNzPSJjb2wtbGctNCBjb2wtbWQtNCBjb2wtMTIgY29sLXNtLTEyIHRleHQtcmlnaHQiPkRldmVsb3BlZCBieTogPGEgdGFyZ2V0PSJfYmxhbmsiIGhyZWY9IiMiPkRldmVsb3Blck5hbWU8L2E+PC9kaXY+CiAgICAgICAgPC9kaXY+CiAgICA8L2Rpdj4KPC9zZWN0aW9uPg==';
        file_put_contents(SYSTEMPATH . '/blog_footer.php', base64_decode($sFooterBackup));
        $bStatus = 1;
    }
    //back to main page
    if ($bStatus) {
        echo '<div class="alert alert-info">Blog ' . $_GET['reset_default'] . ' has been restored.</div>';
        redirect_script(admin_url('admin.php?action=manage&type=layout'));
    }
}
?>

<div class="row">
    <div class="col-12 text-center pt-3"><p>You can use this button to regenerate blog posts html templates again. <a class="btn btn-primary" href="<?php echo admin_url('admin.php?action=manage&type=layout&regenhtml=1'); ?>">Regenerate Blog Templates</a></p></div></div>
<div class="col-12">
    <?php
// Save header.php
    if (isset($_POST['save_header'])) {

        $headercode = html_entity_decode($_POST['headercode']);
        $headerfilepath = SYSTEMPATH . '/blog_header.php';
        file_put_contents($headerfilepath, $headercode);

        echo "<div class='alert alert-success'>Header file updated successfully.</div>";
    }

// Save footer.php
    if (isset($_POST['save_footer'])) {

        $footercode = html_entity_decode($_POST['footercode']);
        $footerfilepath = SYSTEMPATH . '/blog_footer.php';
        file_put_contents($footerfilepath, $footercode);

        echo "<div class='alert alert-success'>Footer file updated successfully.</div>";
    }


// Get File CSS
    $headerfile = 'blog_header.php';
    $headercode = file_get_contents($headerfile);

// Get File Modification Date
    $headerfilemodifitime = filemtime($headerfile);
    $headerfilemodifitime_formated = date(" d/m/Y H:i:s ", $headerfilemodifitime);
    ?>
    <form action="" class="css_editor header_editor" method="post" enctype="multipart/form-data">
        <h2>Header.php</h2>
        <div class="last_modified"><b>Last Modified:</b>  <?php echo $headerfilemodifitime_formated; ?> <button type="submit" name="save_header" class="btn btn-success float-right">Save</button></div>
        <textarea id="headercode" name="headercode"><?= htmlentities($headercode); ?></textarea>
    </form>
    <a href="<?= admin_url('admin.php?action=manage&type=layout&reset_default=header'); ?>" title="RESET" class="confirm" style="position:relative;top:-60px;left:25px;"><button class="btn btn-danger">RESET</button></a>

    <?php
    // Get File CSS
    $footerfile = 'blog_footer.php';
    $footercode = file_get_contents($footerfile);

    // Get File Modification Date
    $footerfilemodifitime = filemtime($footerfile);
    $footerfilemodifitime_formated = date(" d/m/Y H:i:s ", $footerfilemodifitime);
    ?>
    <form action="" class="css_editor footer_editor" method="post" enctype="multipart/form-data">
        <h2>Footer.php</h2>
        <div class="last_modified"><b>Last Modified:</b>  <?php echo $footerfilemodifitime_formated; ?> <button type="submit" name="save_footer" class="btn btn-success float-right">Save</button></div>
        <textarea id="footercode" name="footercode"><?= htmlentities($footercode); ?></textarea>
    </form>
    <a href="<?= admin_url('admin.php?action=manage&type=layout&reset_default=footer'); ?>" title="RESET" class="confirm" style="position:relative;top:-60px;left:25px;"><button class="btn btn-danger">RESET</button></a>
</div>
</div>
