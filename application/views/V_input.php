    <div class="container">

      <form action="<?php echo base_url('C_dashboard/simpan'); ?>" required="rules" method="post" role="form" enctype="multipart/form-data">

            <div style="font-family:roboto" class="row col-xs-12">

                    <div class="form-group col-md-3">
                    <label for="email">Keterangan</label>
                    <input type="waktu" name="keterangan" class="form-control" aria-describedby="Ketrangan" value="Kupon Penerimaan Daging Qurban" 
                    placeholder="" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')">
                </div>

                <div class="form-group col-md-3">
                    <label for="email">Waktu Pengambilan</label>
                    <input type="waktu" name="waktu" class="form-control" aria-describedby="waktu" value="Hari Raya Idul Adha (Mulai Ba'da Dzuhur s/d Selesai)" 
                    placeholder="" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')">
                </div>

                <div class="form-group col-md-3">
                    <label for="tempat">Tempat Pengambilan</label>
                    <input type="tempat" name="tempat" class="form-control" aria-describedby="email" value="Majelis Dzikir Al-Mujahadah (Kediaman Ust.H.Fauzi)" 
                    placeholder="" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')">
                </div>


            <div class="form-group col-md-5"><br>
                <button type="submit" class="btn btn-primary col-md-5">SIMPAN</button>
            </div>

        </div>

    </form>
    