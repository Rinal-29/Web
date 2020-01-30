<?=$this->layout('index');?>
        <div class="breadcrumbs_options" style="margin-bottom: 10px;">
            <a href="<?=BASE_URL;?>"><?=$this->e($front_home);?>&nbsp;</a><i class="fa fa-angle-right yellow"></i>
            <a href="<?=$this->e($social_url);?>"><span class="current"><?=$this->e($page_title);?></span></a>
        </div>
        
       <h3 class="categories-title title"><?=$this->e($page_title);?></h3>
       <div id="myResultContainer" style="margin-top: 20px;" >
        <div style="-webkit-box-sizing: border-box; -moz-box-sizing: border-box;box-sizing: border-box" style="background: #F9F9F9;">
        <table id="tablepages" class="table table-striped table-bordered"  cellspacing="0" >
        <thead style="color: #555;">
            <tr>
                <th style="width: 15px; text-align: center;">No.</th>
                <th><?=$this->e($document_category);?></th>
                <th><?=$this->e($document_title);?></th>
                <th style="width:150px;text-align: center;"><?=$this->e($document_date);?></th>
                <th style="width: 20px;"><?=$this->e($document_file);?></th>
            </tr>
        </thead>
        <tfoot>
        
            <tr>
                <th style="width: 15px; text-align: center;">No.</th>
                <th><?=$this->e($document_category);?></th>
                <th><?=$this->e($document_title);?></th>
                <th style="width:150px;text-align: center;"><?=$this->e($document_date);?></th>
                <th style="width: 20px;"><?=$this->e($document_file);?></th>
            </tr>
        </tfoot>
        <tbody>
        <?php
            $no=1;
            $documents = $this->document()->getDocFromCategory('id_document_category DESC', $category,  WEB_LANG_ID);
            foreach($documents as $docs){
                $documents_category = $this->document()->getDocCategory($docs['id_document'], WEB_LANG_ID);
        ?>
        <tr>
                <td style="text-align: center;"><?=$no;?></td>
                <td><?=$documents_category;?></td>
                <td><?=$docs['title'];?></td>
                <td style="text-align: center;"><?=$this->pocore()->call->podatetime->tgl_indo($docs['publishdate']);?></td>
                <td>
                <?php if(!empty($docs['picture'])){ ?>
                <center><a href="<?=BASE_URL;?>/<?=DIR_CON;?>/uploads/<?=$docs['picture'];?>" target="_blank"><img src="<?=$this->asset('/images/imgSmallDownloadPDF.png');?>"></a></center>
                <?php } ?>
                </td>
            </tr>
        <?php $no++; } ?>
        </tbody>
    </table>
    </div>
    </div>