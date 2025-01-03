<?php

namespace App\Console\Commands;

use App\Models\Blogs;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SitemapCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:sitemap {--year=} {--month=} {--news=1}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command For generate Sitemap.xml';
    public $xml;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->xml = new \DOMDocument('1.0');
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $baseurl = config('nnd.link-online');
        $fileExist = true;
        $fileNews = true;
        $year = $this->option('year') ?? Carbon::now()->format('Y');
        $month = $this->option('month') ?? Carbon::now()->format('m');
        $fileName = 'sitemap.xml';
        try {
            $this->xml->load(('public/'.$fileName));
        } catch (\Throwable $th) {
            $fileExist = false;
        }
        if (empty($this->option('news'))) {
            $main = '<url>
                    <loc>'.$baseurl.'</loc>
                    <lastmod>'.Carbon::now()->format('Y-m-d\TH:i:s.uP').'</lastmod>
                    <changefreq>yearly</changefreq>
                    <priority>1.0</priority>
                </url>
                <url>
                    <loc>'.$baseurl.'/blog</loc>
                    <lastmod>'.Carbon::now()->format('Y-m-d\TH:i:s.uP').'</lastmod>
                    <changefreq>daily</changefreq>
                    <priority>0.9</priority>
                </url>
                <url>
                    <loc>'.$baseurl.'/registrasi-anggota</loc>
                    <lastmod>'.Carbon::now()->format('Y-m-d\TH:i:s.uP').'</lastmod>
                    <changefreq>yearly</changefreq>
                    <priority>0.9</priority>
                </url>
                <url>
                    <loc>'.$baseurl.'/privacy-policy</loc>
                    <lastmod>'.Carbon::now()->format('Y-m-d\TH:i:s.uP').'</lastmod>
                    <changefreq>yearly</changefreq>
                    <priority>0.9</priority>
                </url>
                <url>
                    <loc>'.$baseurl.'/konfirmasi-pembayaran</loc>
                    <lastmod>'.Carbon::now()->format('Y-m-d\TH:i:s.uP').'</lastmod>
                    <changefreq>yearly</changefreq>
                    <priority>0.9</priority>
                </url>';
            $this->fGenerateItem($main);
        // for news-sitemap
        } else {
            $fileName = 'news-sitemap.xml';
            $dataArtikel = Blogs::select('id', 'slug', 'title')->whereNull('deleted_at');
            try {
                $this->xml->load(('public/'.$fileName));
            } catch (\Throwable $th) {
                $fileExist = false;
            }
            if( $fileExist ) {
                try {
                    $urlset = $this->xml->getElementsByTagName('urlset')->item(0);
                    $keyIDLelang = $this->xml->getElementsByTagName('url')->length; //5
                    $path = $this->xml->getElementsByTagName('url')[($keyIDLelang - 1)];
                    $lastArticleId = $path->getAttribute('article-id') ?? 0;
                } catch (\Throwable $th) {
                    $lastArticleId = 0;
                }
                if ($lastArticleId != 0 && !empty($lastArticleId)) {
                    $dataArtikel = $dataArtikel->where('id', '>', $lastArticleId)->orderBy('id', 'asc')->limit(2500)->get();
                } else {
                    $dataArtikel = $dataArtikel->orderBy('id', 'asc')->limit(2500)->get();
                }
                if (count($dataArtikel) < 1) {
                    return \fLogs('=========SITEMAP HAS UPTODATE BOSS!=========', 's');
                }

            foreach ($dataArtikel as $item) {
                $loc = $this->fAddElement('url', $urlset);
                $loc->setAttribute('article-id', $item->id);
                $locVal = $this->fAddElement('loc', $loc);
                $this->fAddValueElement($baseurl.'/blog/'.$item->slug, $locVal);
                $lastmodeVal = $this->fAddElement('lastmod', $loc);
                $this->fAddValueElement(Carbon::now()->format('Y-m-d\TH:i:s.uP'), $lastmodeVal);
                $changefreqVal = $this->fAddElement('changefreq', $loc);
                $this->fAddValueElement('never', $changefreqVal);
                $priorityVal = $this->fAddElement('priority', $loc);
                $this->fAddValueElement('0.5', $priorityVal);

                $test = $this->xml->save(('public/'.$fileName));
            }

            }else{
                $dataArtikel = $dataArtikel->orderBy('id', 'asc')->limit(2500)->get();

                $sitemap = '';
                foreach ($dataArtikel as $item) {
                    $sitemap .= '<url article-id="'.$item->id.'"><loc>'.$baseurl.'/blog/'.$item->slug.'</loc><lastmod>'.Carbon::now()->format('Y-m-d\TH:i:s.uP').'</lastmod>';
                    $sitemap .= '<changefreq>never</changefreq><priority>0.5</priority></url>';
                }

                $this->fGenerateItem($sitemap, $fileName);

            }
            \fLogs('Data Appended successfully.', 's');
        }
        \fLogs('File sitemap terbaru berhasil generate.', 's');

        return true;
    }

    private function fGenerateItem($item, $fileName = 'sitemap.xml')
    {
        $content_header = '<?xml version=\'1.0\' encoding=\'UTF-8\'?>
        <urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
                 xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"
                 xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        try {
            Storage::disk('htdocs')->put($fileName, $content_header.$item.'</urlset>');
        } catch (\Throwable $th) {
            Log::error($th);
        }

        return true;
    }

    public function fAddElement($e_name, $parent)
    {
        $node = $this->xml->createElement($e_name);
        $parent->appendChild($node);

        return $node;
    }

    public function fAddValueElement($value, $parent)
    {
        $value = $this->xml->createTextNode($value);
        $parent->appendChild($value);

        return $value;
    }
}
