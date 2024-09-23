<section class="contact py-5">
    <div class="container-xl">
        <h2>Head Office</h2>
        <div class="row">
            <div class="col-md-6">
                <ul class="fa-ul">
                    <li class="mb-4"><span class="fa-li"><i class="fa-solid fa-map-marker-alt"></i></span>
                        <?=get_field('mailing_address','options')?></li>
                    <li class="mb-4"><span class="fa-li"><i class="fa-solid fa-map-marker-alt"></i></span>
                        <?=get_field('shipping_address','options')?></li>
                    <li><span class="fa-li"><i class="fa-solid fa-phone"></i></span>
                        <a href="tel:<?=get_field('contact_phone','options')?>"><?=get_field('contact_phone','options')?></a></li>
                    <li><span class="fa-li"><i class="fa-solid fa-fax"></i></span>
                        <?=get_field('contact_fax','options')?></li>
                    <li><span class="fa-li"><i class="fa-solid fa-envelope"></i></span>
                        <a href="mailto:<?=get_field('contact_email','options')?>"><?=get_field('contact_email','options')?></a></li>
                </ul>
            </div>
            <div class="col-md-6">
                <iframe src="<?=get_field('maps_url','options')?>" width="100%" height="450" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</section>