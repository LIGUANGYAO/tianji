<?php

namespace app\store\model\bargain;

use think\Cache;
use app\common\model\bargain\Setting as SettingModel;

/**
 * 砍价活动设置模型
 * Class Setting
 * @package app\store\model\bargain
 */
class Setting extends SettingModel
{
    /**
     * 设置项描述
     * @var array
     */
    private $describe = [
        'basic' => '基础设置',
    ];

    /**
     * 更新系统设置
     * @param $key
     * @param $values
     * @return bool
     * @throws \think\exception\DbException
     */
    public function edit($key, $values)
    {
        $model = self::detail($key) ?: $this;
        // 删除系统设置缓存
        Cache::rm('bargain_setting_' . self::$wxapp_id);
        return $model->save([
                'key' => $key,
                'describe' => $this->describe[$key],
                'values' => $values,
                'wxapp_id' => self::$wxapp_id,
            ]) !== false;
    }

}