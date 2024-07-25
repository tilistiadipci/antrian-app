<style>
    #printarea {
        display: none;
        text-align: center
    }

    @media print {

        #loader-wrapper,
        header,
        #main,
        footer,
        #toast-container {
            display: none
        }

        #printarea {
            display: block;
        }
    }

    @page {
        margin: 0
    }

    .blackprint {
        filter: gray;
        /* IE6-9 */
        -webkit-filter: grayscale(1);
        /* Google Chrome, Safari 6+ & Opera 15+ */
        filter: grayscale(1);
        /* Microsoft Edge and Firefox 35+ */
    }
</style>
<div id="printarea" style="line-height:1.25">
    <span style="font-size:25px">{{ session()->get('department_name') }}</span><br>
    <span style="font-size:20px">No Antrian Anda</span><br>
    <span>
        <h3 style="font-size:70px;font-weight:bold;margin:0;line-height:1.5">{{ session()->get('number') }}</h3>
    </span>
    <span style="font-size:20px">Harap tunggu giliran Anda</span><br>
    <span style="font-size:20px">Menunggu: {{ session()->get('total') - 1 }} orang</span><br><br><br>
    <span style="float:left">{{ \Carbon\Carbon::now()->format('d-m-Y') }}</span><span
        style="float:right">{{ \Carbon\Carbon::now()->format('h:i:s A') }}</span>
</div>
