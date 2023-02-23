<style>

    .card {
        border: none;
        border-radius: 10px
    }

    .c-details span {
        font-weight: 300;
        font-size: 13px
    }

    .icon {
        width: 50px;
        height: 50px;
        background-color: #eee;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 39px
    }

    .badge span {
        background-color: #fffbec;
        width: 60px;
        height: 25px;
        padding-bottom: 3px;
        border-radius: 5px;
        display: flex;
        color: #fed85d;
        justify-content: center;
        align-items: center
    }

    .progress {
        height: 10px;
        border-radius: 10px
    }

    .progress div {
        background-color: red
    }

    .text1 {
        font-size: 14px;
        font-weight: 600
    }

    .text2 {
        color: #a5aec0
    }
</style>
<div class="container mt-5 mb-3">
    <div class="row">
        <?php foreach($poll as $i){ ?>
            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
<!--                        <div class="d-flex flex-row align-items-center">-->
<!--                            <div class="ms-2 c-details">-->
<!--                                <h6 class="mb-0">--><?php //echo $i['first_name']; ?><!--</h6></span>-->
<!--                            </div>-->
<!--                        </div>-->
                        <div class="badge"><a href="<?php echo site_url('election/vote/'.$i['id']."/".$i['verify_key']); ?>"  class="btn btn-primary" target="_blank">Vote</a></div>
						  <div class="badge"><a href="<?php echo site_url('/election/showPollVoteAndResultFromElection/'.$i['id'].'/'.$i['name'].'/'.$i['verify_key']); ?>"  class="btn btn-primary" target="_blank">Result</a></div>
                    </div>
                    <div class="mt-5">
                        <h3 class="heading"><?php echo $i['name']; ?></h3>
                        <div class="mt-5">
                            <div class="mt-3"> <span class="text1">End : <?php echo $i['expire_date']; ?> <span class="text2"></div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>



<!--        <div class="col-md-4">-->
<!--            <div class="card p-3 mb-2">-->
<!--                <div class="d-flex justify-content-between">-->
<!--                    <div class="d-flex flex-row align-items-center">-->
<!--                        <div class="icon"> <i class="bx bxl-reddit"></i> </div>-->
<!--                        <div class="ms-2 c-details">-->
<!--                            <h6 class="mb-0">Reddit</h6> <span>2 days ago</span>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="badge"><button>View</button></div>-->
<!--                </div>-->
<!--                <div class="mt-5">-->
<!--                    <h3 class="heading">Software Architect <br>Java - USA</h3>-->
<!--                    <div class="mt-5">-->
<!--                        <div class="progress">-->
<!--                            <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>-->
<!--                        </div>-->
<!--                        <div class="mt-3"> <span class="text1">52 Applied <span class="text2">of 100 capacity</span></span> </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="col-md-4">-->
<!--            <div class="card p-3 mb-2">-->
<!--                <div class="d-flex justify-content-between">-->
<!--                    <div class="d-flex flex-row align-items-center">-->
<!--                        <div class="icon"> <i class="bx bxl-reddit"></i> </div>-->
<!--                        <div class="ms-2 c-details">-->
<!--                            <h6 class="mb-0">Reddit</h6> <span>2 days ago</span>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="badge"><button>View</button></div>-->
<!--                </div>-->
<!--                <div class="mt-5">-->
<!--                    <h3 class="heading">Software Architect <br>Java - USA</h3>-->
<!--                    <div class="mt-5">-->
<!--                        <div class="progress">-->
<!--                            <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>-->
<!--                        </div>-->
<!--                        <div class="mt-3"> <span class="text1">52 Applied <span class="text2">of 100 capacity</span></span> </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="col-md-4">-->
<!--            <div class="card p-3 mb-2">-->
<!--                <div class="d-flex justify-content-between">-->
<!--                    <div class="d-flex flex-row align-items-center">-->
<!--                        <div class="icon"> <i class="bx bxl-reddit"></i> </div>-->
<!--                        <div class="ms-2 c-details">-->
<!--                            <h6 class="mb-0">Reddit</h6> <span>2 days ago</span>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="badge"><button>View</button></div>-->
<!--                </div>-->
<!--                <div class="mt-5">-->
<!--                    <h3 class="heading">Software Architect <br>Java - USA</h3>-->
<!--                    <div class="mt-5">-->
<!--                        <div class="progress">-->
<!--                            <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>-->
<!--                        </div>-->
<!--                        <div class="mt-3"> <span class="text1">52 Applied <span class="text2">of 100 capacity</span></span> </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="col-md-4">-->
<!--            <div class="card p-3 mb-2">-->
<!--                <div class="d-flex justify-content-between">-->
<!--                    <div class="d-flex flex-row align-items-center">-->
<!--                        <div class="icon"> <i class="bx bxl-reddit"></i> </div>-->
<!--                        <div class="ms-2 c-details">-->
<!--                            <h6 class="mb-0">Reddit</h6> <span>2 days ago</span>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="badge"><button>View</button></div>-->
<!--                </div>-->
<!--                <div class="mt-5">-->
<!--                    <h3 class="heading">Software Architect <br>Java - USA</h3>-->
<!--                    <div class="mt-5">-->
<!--                        <div class="progress">-->
<!--                            <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>-->
<!--                        </div>-->
<!--                        <div class="mt-3"> <span class="text1">52 Applied <span class="text2">of 100 capacity</span></span> </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
</div>

<br>
<br>