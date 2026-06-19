<?php

/**
 * 站点元信息示例：使用数组存储站点元数据，并提供生成简短描述文本的方法。
 * 本文件仅用于演示数据组织与输出，不包含任何网络请求或系统调用。
 */

/**
 * 获取站点元信息数组
 *
 * @return array
 */
function getSiteMeta(): array
{
    return [
        'site_name' => '华体会体育',
        'site_url'  => 'https://index-main-hth.com.cn',
        'keywords'  => ['华体会', '体育', '赛事', '竞猜'],
        'description' => '华体会体育官方平台，提供丰富的体育赛事和竞猜服务。',
        'language'  => 'zh-CN',
        'charset'   => 'UTF-8',
    ];
}

/**
 * 根据元信息生成简短的描述文本
 *
 * @param array $meta 站点元信息数组
 * @return string
 */
function generateShortDescription(array $meta): string
{
    $name = $meta['site_name'] ?? '';
    $url  = $meta['site_url'] ?? '';
    $desc = $meta['description'] ?? '';
    $kw   = $meta['keywords'] ?? [];

    $keywordString = implode('、', array_slice($kw, 0, 3));

    if ($name && $url) {
        return "{$name} ({$url}) - {$desc} 关键词：{$keywordString}。";
    } elseif ($name) {
        return "{$name} - {$desc} 关键词：{$keywordString}。";
    } else {
        return $desc ?: '暂无描述信息。';
    }
}

/**
 * 生成 HTML 友好的描述（转义输出）
 *
 * @param array $meta
 * @return string
 */
function generateSafeHtmlDescription(array $meta): string
{
    $plain = generateShortDescription($meta);
    return htmlspecialchars($plain, ENT_QUOTES, 'UTF-8');
}

// 示例用法（不执行任何网络/系统操作）
$meta     = getSiteMeta();
$descText = generateShortDescription($meta);
$descHtml = generateSafeHtmlDescription($meta);

// 输出示例（纯文本，仅在命令行或日志环境使用）
echo "简短描述文本（纯文本）：\n";
echo $descText . "\n\n";

echo "简短描述文本（HTML转义）：\n";
echo $descHtml . "\n";

// 额外说明：可打印站点 URL 与关键词
echo "\n站点URL: " . $meta['site_url'] . "\n";
echo "核心关键词: " . implode(', ', $meta['keywords']) . "\n";