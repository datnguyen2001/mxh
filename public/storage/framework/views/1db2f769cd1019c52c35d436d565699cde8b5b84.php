
<?php $__env->startSection('title'); ?><?php echo e(config('metapage.Home.title')); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('description'); ?><?php echo e(config('metapage.Home.description')); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('keywords'); ?><?php echo e(config('metapage.Home.keywords')); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('news_keywords'); ?><?php echo e(config('metapage.Home.news_keywords')); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('og-title'); ?><?php echo e(config('metapage.Home.og:title')); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('og-description'); ?><?php echo e(config('metapage.Home.og:description')); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('OgUrl'); ?><?php echo e(config('siteInfo.site_path').Request::getPathInfo()); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('OgImage'); ?><?php echo e(config('metapage.Home.og:image')); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('Link-rss'); ?><?php echo e(config('siteInfo.site_path') . '/rss/home.rss'); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('logo_home'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<?php if(!empty($boxFocusHome1)): ?>
    <?php $__currentLoopData = $boxFocusHome1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><link rel="preload" href="<?php echo $item->ThumbImage; ?>" as="image" fetchpriority="high"><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php if(!empty($boxFocusHome2)): ?>
    <?php $__currentLoopData = $boxFocusHome2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><link rel="preload" href="<?php echo $item->ThumbImage; ?>" as="image" fetchpriority="high"><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
    <?php echo $__env->make('expert.Css-home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('schema.SchemaHome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <?php echo $__env->make('expert.Js-home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div id="home-xam" class="hidden"></div>

<div class="home__focus-hm">
    <div class="container">
        <div class="box-flex-focus">
            <div class="box-left">
                <?php if (isset($component)) { $__componentOriginal758901f45a1eb2d8259e0870a2c976ad46869669 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Template\BoxLayout1::class, ['listNews' => $boxFocusHome1,'zoneInfo' => '']); ?>
<?php $component->withName('template::box-layout1'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
                     <?php $__env->slot('cdKey', null, []); ?> <?php echo e(config('siteInfo.SITE_ID')); ?>newsposition:zoneid0type1 <?php $__env->endSlot(); ?>
                     <?php $__env->slot('cdTop', null, []); ?> 3 <?php $__env->endSlot(); ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal758901f45a1eb2d8259e0870a2c976ad46869669)): ?>
<?php $component = $__componentOriginal758901f45a1eb2d8259e0870a2c976ad46869669; ?>
<?php unset($__componentOriginal758901f45a1eb2d8259e0870a2c976ad46869669); ?>
<?php endif; ?>
            </div>

            <div class="box-right">
                <?php if (isset($component)) { $__componentOriginale7e35d47841237298a3069594c50b7d6a20b3721 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Template\BoxLayout2::class, ['listNews' => $boxFocusHome2]); ?>
<?php $component->withName('template::box-layout2'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
                     <?php $__env->slot('cdKey', null, []); ?> <?php echo e(config('siteInfo.SITE_ID')); ?>newsposition:zoneid0type1 <?php $__env->endSlot(); ?>
                     <?php $__env->slot('cdTop', null, []); ?> 4 <?php $__env->endSlot(); ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale7e35d47841237298a3069594c50b7d6a20b3721)): ?>
<?php $component = $__componentOriginale7e35d47841237298a3069594c50b7d6a20b3721; ?>
<?php unset($__componentOriginale7e35d47841237298a3069594c50b7d6a20b3721); ?>
<?php endif; ?>
            </div>
        </div>
        <div class="mb-20">
            <!-- Ads Top_TNV Zone -->
            <zone id="m15w8p32"></zone>
            <script src="//media1.admicro.vn/cms/arf-m15w8p32.min.js"></script>
            <!-- / Ads Zone -->
        </div>
    </div>
</div>

<div class="home__stream">
    <div class="container">
        <div class="stream-flex">
            <div class="box-left-stream">
                <?php if (isset($component)) { $__componentOriginal4b2c02665b8a4b8e796bbf103e4ead40e0c166c4 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Template\BoxLayout3::class, ['listNews' => $listStreamHome]); ?>
<?php $component->withName('template::box-layout3'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
                     <?php $__env->slot('cdKey', null, []); ?> <?php echo e(config('siteInfo.SITE_ID')); ?>newsinzoneisonhome:zone0 <?php $__env->endSlot(); ?>
                     <?php $__env->slot('cdTop', null, []); ?> 10 <?php $__env->endSlot(); ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4b2c02665b8a4b8e796bbf103e4ead40e0c166c4)): ?>
<?php $component = $__componentOriginal4b2c02665b8a4b8e796bbf103e4ead40e0c166c4; ?>
<?php unset($__componentOriginal4b2c02665b8a4b8e796bbf103e4ead40e0c166c4); ?>
<?php endif; ?>
            </div>

            <div class="box-right-stream">
                <div class="box-category-layout-flex">
                    <div class="col-left">





                        <?php if (isset($component)) { $__componentOriginal7d34fa795bf81988383033e8cacd45caf62aa5d4 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Template\BoxLayout4::class, ['listNews' => $dataByZone['gioi-tre/thanh-nien-khoi-nghiep']['data']??'','zoneInfo' => $dataByZone['gioi-tre/thanh-nien-khoi-nghiep']['info']??'']); ?>
<?php $component->withName('template::box-layout4'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
                             <?php $__env->slot('cdKey', null, []); ?> <?php echo e($dataByZone['gioi-tre/thanh-nien-khoi-nghiep']['cdKey']??''); ?> <?php $__env->endSlot(); ?>
                             <?php $__env->slot('cdTop', null, []); ?> 4 <?php $__env->endSlot(); ?>
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7d34fa795bf81988383033e8cacd45caf62aa5d4)): ?>
<?php $component = $__componentOriginal7d34fa795bf81988383033e8cacd45caf62aa5d4; ?>
<?php unset($__componentOriginal7d34fa795bf81988383033e8cacd45caf62aa5d4); ?>
<?php endif; ?>

                    </div>

                    <div class="col-right">
                        <?php if (isset($component)) { $__componentOriginald99c8998fa5727d119d903be239ad0ccf49cc83a = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Template\BoxLayout5::class, ['listNewsPapers' => $boxAnpham]); ?>
<?php $component->withName('template::box-layout5'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
                             <?php $__env->slot('cdKey', null, []); ?> <?php echo e(config('siteInfo.SITE_ID')); ?>magazine:type2 <?php $__env->endSlot(); ?>
                             <?php $__env->slot('cdTop', null, []); ?> 1 <?php $__env->endSlot(); ?>
                             <?php $__env->slot('zoneName', null, []); ?> Ấn phẩm <?php $__env->endSlot(); ?>
                             <?php $__env->slot('zoneUrl', null, []); ?> /an-pham.htm  <?php $__env->endSlot(); ?>
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald99c8998fa5727d119d903be239ad0ccf49cc83a)): ?>
<?php $component = $__componentOriginald99c8998fa5727d119d903be239ad0ccf49cc83a; ?>
<?php unset($__componentOriginald99c8998fa5727d119d903be239ad0ccf49cc83a); ?>
<?php endif; ?>
                    </div>
                </div>

                <div class="box-interface">
                    <?php if (isset($component)) { $__componentOriginala83e43ac7d001a8c6d57c623ae705b0b50e138be = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Template\BoxLayout6::class, ['listNews' => $dataByZone['thoi-su']['data']??'','zoneInfo' => $dataByZone['thoi-su']['info']??'']); ?>
<?php $component->withName('template::box-layout6'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
                         <?php $__env->slot('cdKey', null, []); ?> <?php echo e($dataByZone['thoi-su']['cdKey']??''); ?> <?php $__env->endSlot(); ?>
                         <?php $__env->slot('cdTop', null, []); ?> <?php echo e($dataByZone['thoi-su']['cdTop']??''); ?> <?php $__env->endSlot(); ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala83e43ac7d001a8c6d57c623ae705b0b50e138be)): ?>
<?php $component = $__componentOriginala83e43ac7d001a8c6d57c623ae705b0b50e138be; ?>
<?php unset($__componentOriginala83e43ac7d001a8c6d57c623ae705b0b50e138be); ?>
<?php endif; ?>
                </div>

                <div class="box-category-layout-flex">
                    <?php if(!empty($boxEmagazine)): ?>
                    <div class="col-left">
                        <?php if (isset($component)) { $__componentOriginal5cd6d30e54f8354c6303a8b01c3f67866e2cd3f2 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Template\BoxLayout7::class, ['listNews' => $boxEmagazine,'zoneInfo' => '']); ?>
<?php $component->withName('template::box-layout7'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
                             <?php $__env->slot('cdKey', null, []); ?>  <?php $__env->endSlot(); ?>
                             <?php $__env->slot('cdTop', null, []); ?> 2 <?php $__env->endSlot(); ?>
                             <?php $__env->slot('zoneName', null, []); ?> Emagazine  <?php $__env->endSlot(); ?>
                             <?php $__env->slot('zoneUrl', null, []); ?> /emagazine.htm  <?php $__env->endSlot(); ?>
                             <?php $__env->slot('icon', null, []); ?> 
                                <span class="icon">
                                  <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                       xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_119_7362)">
                                      <path
                                          d="M6.35894 1.54956L9.42888 5.04753L14.0529 4.50562L11.6734 8.50439L13.6204 12.7312L9.07999 11.7047L5.66115 14.8638L5.2339 10.2299L1.17384 7.95655L5.44927 6.11386L6.35894 1.54956Z"
                                          stroke="#ED2024" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </g>
                                    <defs>
                                      <clipPath id="clip0_119_7362">
                                        <rect width="16" height="16" fill="white" />
                                      </clipPath>
                                    </defs>
                                  </svg>
                                </span>
                             <?php $__env->endSlot(); ?>

                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5cd6d30e54f8354c6303a8b01c3f67866e2cd3f2)): ?>
<?php $component = $__componentOriginal5cd6d30e54f8354c6303a8b01c3f67866e2cd3f2; ?>
<?php unset($__componentOriginal5cd6d30e54f8354c6303a8b01c3f67866e2cd3f2); ?>
<?php endif; ?>
                    </div>
                    <?php endif; ?>
                    <div class="col-right">
                        <?php if (isset($component)) { $__componentOriginald99c8998fa5727d119d903be239ad0ccf49cc83a = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Template\BoxLayout5::class, ['listNewsPapers' => $boxTapchi]); ?>
<?php $component->withName('template::box-layout5'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
                             <?php $__env->slot('cdKey', null, []); ?> <?php echo e(config('siteInfo.SITE_ID')); ?>magazine:type1 <?php $__env->endSlot(); ?>
                             <?php $__env->slot('cdTop', null, []); ?> 1 <?php $__env->endSlot(); ?>
                             <?php $__env->slot('zoneName', null, []); ?> Tạp chí <?php $__env->endSlot(); ?>
                             <?php $__env->slot('zoneUrl', null, []); ?> /tap-chi.htm  <?php $__env->endSlot(); ?>
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald99c8998fa5727d119d903be239ad0ccf49cc83a)): ?>
<?php $component = $__componentOriginald99c8998fa5727d119d903be239ad0ccf49cc83a; ?>
<?php unset($__componentOriginald99c8998fa5727d119d903be239ad0ccf49cc83a); ?>
<?php endif; ?>
                    </div>
                </div>

                <div class="box-interface">
                    <?php if (isset($component)) { $__componentOriginala83e43ac7d001a8c6d57c623ae705b0b50e138be = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Template\BoxLayout6::class, ['listNews' => $dataByZone['gioi-tre']['data']??'','zoneInfo' => $dataByZone['gioi-tre']['info']??'']); ?>
<?php $component->withName('template::box-layout6'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
                         <?php $__env->slot('cdKey', null, []); ?> <?php echo e($dataByZone['gioi-tre']['cdKey']??''); ?> <?php $__env->endSlot(); ?>
                         <?php $__env->slot('cdTop', null, []); ?> <?php echo e($dataByZone['gioi-tre']['cdTop']??''); ?> <?php $__env->endSlot(); ?>
                         <?php $__env->slot('classAvt', null, []); ?> blue <?php $__env->endSlot(); ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala83e43ac7d001a8c6d57c623ae705b0b50e138be)): ?>
<?php $component = $__componentOriginala83e43ac7d001a8c6d57c623ae705b0b50e138be; ?>
<?php unset($__componentOriginala83e43ac7d001a8c6d57c623ae705b0b50e138be); ?>
<?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="box-stream-item box-stream-item-load"></div>
<div class="list__viewmore"></div>
<div class="configHidden">
    <?php echo $ZoneInfoClientScript ?? ''; ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\mxh-v2-main\resources\views/home/index.blade.php ENDPATH**/ ?>