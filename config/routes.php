<?php
return array(
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
'contakt' => 'contakt/index',
'FAcreate' => 'FA/create',
'faEditOne/([0-9]+)' => 'FA/editOne/$1',
'FAedit' => 'FA/edit',
'FAlookOne/([0-9]+)' => 'FA/lookOne/$1',
'FAlook/page-([0-9]+)' => 'FA/look/$1',
'FAlook' => 'FA/look',
'FA/upload/([0-9]+)' => 'FA/upload/$1',
'Fullnew/([0-9]+)' => 'news/fullnew/$1',
'indexVote' => 'admin/vote',
'index' => 'site/index',
'main/page-([0-9]+)' => 'site/index/$1',
'main' => 'site/index',
'metaTags/([0-9]+)' => 'auxiliary/MetaTagsOne/$1',
'metaTags' => 'auxiliary/metaTags',
'metaTagsNew' => 'auxiliary/metaTagsNew',
'newsAdd' => 'news/newsAdd',
'newsCatEdit' => 'admin/newsCatEdit',
'newscat/([0-9]+)/page-([0-9]+)' => 'news/index/$1/$2',
'newscat/([0-9]+)' => 'news/index/$1',
'newsCommentEdit/page-([0-9]+)' => 'news/newsCommentEdit/$1',
'newsCommentEdit' => 'news/newsCommentEdit',
'newsEditComOne/([0-9]+)/page-([0-9]+)' => 'news/newsEditComOne/$1/$2',
'news/([0-9]+)' => 'site/viewnews/$1',
'newsEditOne/([0-9]+)/page-([0-9]+)' => 'news/newsEditOne/$1/$2',
'newsEditID/' => 'news/newsEditID',
'newsEdit/page-([0-9]+)' => 'news/newsEdit/$1',
'newsEdit' => 'news/newsEdit',
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
'videoChange/page-([0-9]+)' => 'video/changeVideo/$1',
'videoChange' => 'video/changeVideo',
'video' => 'video/index',
'voteActive' => 'admin/voteActive',
'voteEdit' => 'admin/voteEdit',
'voteOne/([0-9]+)' => 'admin/voteOne/$1',
'voteShow' => 'admin/voteShow',
'voteShowOne/([0-9]+)' => 'admin/voteShowOne/$1',
'vote' => 'admin/vote',
'uploadDZ' => 'FA/dropZone/$1',
'userChangedata' => 'user/changeData',
'userNews/page-([0-9]+)' => 'user/userComment/$1',
'userNews' => 'user/userComment',
'userAuthor' => 'user/author',
'userLogin' => 'user/index',
'userUnreg' => 'user/unreg',
'userWishes/([0-9]+)' => 'user/userWishes/$1',
'userWishes' => 'user/userWishes',
'page-([0-9]+)' => 'site/index/$1',
'' => 'site/index',
	);
?>