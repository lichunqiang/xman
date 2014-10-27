<?php
Yii::setAlias('view', '@frontend/views');
Yii::setAlias('modules', '@frontend/modules');

\Yii::$container->set('frontend\components\BookingInterface', 'frontend\components\BookingService');
