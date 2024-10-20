<?php
return array(
'archives' => 'site/archive',
'admin' => 'admin/index',
'admin/page-([0-9]+)' => 'admin/index/$1',
'apiSaveNews' => 'API/SaveNews',
'apiDozWithParam' => 'API/apiDozWithParam',
'apidoz' => 'API/doz',
'apinewsById' => 'API/newsById',
'apinewsByPageLim/([0-9]+)/([0-9]+)' => 'API/newsByPageLim/$1/$2',
'apinewsWithParam' => 'API/newsWithParam',
'apinews' => 'API/news',
'apiPosterById' => 'API/posterById',
'apiPoster' => 'API/poster',
'apiUpdateCountdoz' => 'API/apiUpdateCountdoz',
'archive/([0-9]+)/([0-9]+)/page-([0-9]+)' => 'news/archive/$1/$2/$3',
'archive/([0-9]+)/([0-9]+)' => 'news/archive/$1/$2',
'cSubEdit' => 'calculator/cSubEdit',
'calctypes' => 'calculator/typesCalculator',
'cEdit' => 'calculator/edit',
'calcLength' => 'calculator/length',
'clCalk' => 'calculator/viewUsers',
'contakt' => 'contakt/index',
'checkFilesNews' => 'news/checkFilesNews',
'clickButton/([0-9]+)' => 'clickButton/gov/$1',
'countClickButton' => 'clickButton/countClickButton',
'countUser' => 'admin/countUser',
'FAadd_Photo' => 'FA/add_Photo',
'FAcreate' => 'FA/create',
'faEditOne/([0-9]+)' => 'FA/editOne/$1',
'FAedit/page-([0-9]+)' => 'FA/edit/$1',
'FAedit' => 'FA/edit',
'FAlookOne/([0-9]+)' => 'FA/lookOne/$1',
'FAlook/page-([0-9]+)' => 'FA/look/$1',
'FAlook' => 'FA/look',
'FA/upload/([0-9]+)' => 'FA/upload/$1',
'findNews' => 'news/findNews',
'Fullnew/([0-9]+)' => 'news/fullnew/$1',
'indexVote' => 'Vote/vote',
'index/page-([0-9]+)' => 'site/index/$1',
'index' => 'site/index',
'insuranceAutosign' => 'insurance/autosign',
'insuranceCommentEdit/page-([0-9]+)' => 'insurance/insuranceCommentEdit/$1',
'insuranceCommentEdit' => 'insurance/insuranceCommentEdit',
'insurance' => 'insurance/index',
'main/page-([0-9]+)' => 'site/index/$1',
'main' => 'site/index',
'metaTags/([0-9]+)' => 'metaTags/MetaTagsOne/$1',
'metaTags' => 'metaTags/metaTags',
'metaTagsNew' => 'metaTags/metaTagsNew',
'newsAdd' => 'news/newsAdd',
'newsCatEdit' => 'admin/newsCatEdit',
'newscat/([0-9]+)/page-([0-9]+)' => 'news/index/$1/$2',
'newscat/([0-9]+)' => 'news/index/$1',
'newsCommentEdit/page-([0-9]+)' => 'news/newsCommentEdit/$1',
'newsCommentEdit' => 'news/newsCommentEdit',
'newsEditComOne/([0-9]+)/page-([0-9]+)' => 'news/newsEditComOne/$1/$2',
'newsEditOne/([0-9]+)/page-([0-9]+)' => 'news/newsEditOne/$1/$2',
'newsEditID/' => 'news/newsEditID',
'newsEdit/page-([0-9]+)' => 'news/newsEdit/$1',
'newsEdit' => 'news/newsEdit',
'newsFB' => 'news/FB_SDK',
'newsPrint/([0-9]+)' => 'news/newsPrint/$1',
'posterAdd' => 'poster/add',
'posterCatFull/([0-9]+)/page-([0-9]+)' => 'poster/posterCatFull/$1/$2',
'posterCatFull/([0-9]+)' => 'poster/posterCatFull/$1',
'posterCatEd' => 'admin/posterCatEd',
'posterCat' => 'poster/index',
'posterEditOne/([0-9]+)/page-([0-9]+)' => 'poster/posterEditOne/$1/$2',
'posterEdit/page-([0-9]+)' => 'poster/posterEdit/$1',
'posterEdit' => 'poster/posterEdit',
'posterFind/page-([0-9]+)' => 'poster/posterFind/$1',
'posterFind' => 'poster/posterFind',
'posterFull/page-([0-9]+)' => 'poster/posterFull/$1',
'posterFull' => 'poster/posterFull',
'posterGr' => 'admin/posterGr',
'posterOne/([0-9]+)' => 'poster/posterOne/$1',
'posterVerify' => 'poster/posterVerify',
'relaxALL/page-([0-9]+)' => 'relax/relaxAll/$1',
'relaxALL' => 'relax/relaxAll',
'ralaxAddAn' => 'relax/relaxAddAn',
'relaxCatAn' => 'admin/relaxCatAn',
'relaxCatAf' => 'admin/relaxCatAf',
'relaxEditOne/([0-9]+)' => 'relax/relaxEditOne/$1',
'relaxEdit/page-([0-9]+)' => 'relax/relaxEdit/$1',
'relaxEdit' => 'relax/relaxEdit',
'relaxFullAnCat/([0-9]+)/page-([0-9]+)' => 'relax/fullAnCat/$1/$2',
'relaxFullAnCat/([0-9]+)' => 'relax/fullAnCat/$1',
'relax/([0-9]+)/page-([0-9]+)' => 'relax/index/$1/$2',
'relax/([0-9]+)' => 'relax/index/$1',
'spam' => 'admin/spam',
'spamEMail' => 'admin/spamEMail',
'topBarlicensekey/([a-z0-9]+)' => 'plugins/licensekey/$1',
'topBar/([a-z]+)' => 'plugins/topBarLang/$1',
'topBar' => 'plugins/topBarRun',
'typeButton' => 'admin/typeButton',
'videoChange/page-([0-9]+)' => 'video/changeVideo/$1',
'videoChange' => 'video/changeVideo',
'video/page-([0-9]+)' => 'video/index/$1',
'video' => 'video/index',
'voteActive' => 'Vote/voteActive',
'voteEdit' => 'Vote/voteEdit',
'voteOne/([0-9]+)' => 'Vote/voteOne/$1',
'voteShow' => 'Vote/voteShow',
'voteShowOne/([0-9]+)' => 'Vote/voteOne/$1',
'uploadDZ' => 'FA/dropZone/$1',
'userAuthor' => 'user/author',
'userChangedata' => 'user/changeData',
'userLogin' => 'user/index',
'userNews/page-([0-9]+)' => 'user/userComment/$1',
'userNews' => 'user/userComment',
'userUnreg' => 'user/unreg',
'usersView' => 'user/usersView',
'userWishes/page-([0-9]+)' => 'user/userWishes/$1',
'userWishes' => 'user/userWishes',
'page-([0-9]+)' => 'site/index/$1',
'polityka' => 'site/polityka',
'' => 'site/index',
	);