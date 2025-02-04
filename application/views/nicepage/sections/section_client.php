<?php
$get_section_client = $this->model_utama->view_where('tbl_nicepage', array('key' => 'section_client'))->row_array();
if (isset($get_section_client['value'])) {
    if (!empty($get_section_client['value'])) {
        $section_client = json_decode($get_section_client['value'], true);
    }
}

// get client logo 
$get_client = array();
if (isset($section_client['jumlah'])) {
    $get_client = $this->db->query(
        "
        SELECT 
            client.id_client as id,
            client.nama as nama,
            client.logo as logo
        FROM 
            tbl_nicepage_client client 
        ORDER BY client.nama ASC 
        LIMIT 0," . $section_client['jumlah']
    )->result_array();
}
?>

<div class="container">
    <div class="card py-4">
        <?php if (!empty($section_client['judul'])) { ?>
            <h2 class="card-header section-title">
                <?php echo strtoupper($section_client['judul']); ?>
            </h2>
        <?php } ?>
        <?php if (!empty($section_client['deskripsi'])) { ?>
            <div class="section-description">
                <?php echo $section_client['deskripsi']; ?>
            </div>
        <?php } ?>
        <div class="card-body">
            <div class="row justify-content-center">


                <div class="marquee-container">
                    <div class="marquee-wrapper ">
                        <div class="marquee">
                            <div class="marq">
                                <div class="items">
                                    <?php foreach ($get_client as $item): ?>
                                        <?php
                                        if ($item['logo'] !== '') {
                                            $img_src = base_url() . 'asset/img_nicepage/client/' . $item['logo'];
                                        }
                                        ?>
                                        <div class="p-4 item">
                                            <img class="" src="<?php echo $img_src; ?>" alt="<?php echo $item['nama']; ?>">
                                        </div>

                                    <?php endforeach; ?>
                                </div>



                                <div class="items">
                                    <?php foreach ($get_client as $item): ?>
                                        <?php
                                        if ($item['logo'] !== '') {
                                            $img_src = base_url() . 'asset/img_nicepage/client/' . $item['logo'];
                                        }
                                        ?>
                                        <div class="p-4 item">
                                            <img class="" src="<?php echo $img_src; ?>" alt="<?php echo $item['nama']; ?>">
                                        </div>

                                    <?php endforeach; ?>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>




            </div>
        </div>
    </div>
</div>



<style>
    .marquee-container {
        overflow: hidden;
        width: 100%;
        height: max-content;
        background: #f8f9fa;
        padding: 10px 0;
        position: relative;
        display: block;
        align-items: center;
    }

    .marquee {
        height: 150px;
        width: 100%;
        overflow: hidden;
        position: relative;

        float: left;
    }

    .marquee .marq {
        display: block;
        width: max-content;
        height: 200px;
        position: absolute;
        overflow: hidden;
        animation: marquee 20s linear infinite;
    }


    .marquee .marq .items {
        display: flex;
        float: left;
        width: 50%;
    }

    .marquee .item {
        height: 150px;
    }

    .marquee .item img {
        height: 100%;
        width: 100%;
        border-radius: 8px;
    }



    @keyframes marquee {
        0% {
            left: 0;
        }

        100% {
            left: -170%;
        }
    }




    /* Duplicate the content for infinite scrolling */
    .marquee-container:hover .marquee .marq {
        animation-play-state: paused;
    }
</style>