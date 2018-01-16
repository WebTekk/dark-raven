<?php
/**
 * Created by PhpStorm.
 * User: marc.wilhelm
 * Date: 16.01.2018
 * Time: 08:50
 */

namespace App\Mapper;


use DOMDocument;
use DOMXPath;

class ZInvoiceMapper extends AbstractMapper
{
    public function getXmlData()
    {
        $doc = new DOMDocument();
        $doc->load(__DIR__ . '/../../resources/files/z-invoice.xml');
        $xpath = new DOMXPath($doc);
        $xpath->registerNameSpace('ns', 'http://tempuri.org/invoice_batch_generic.xsd');

        $elements['invoice_number'] = $xpath->query("//ns:invoice_number")->item(0)->nodeValue;
        $elements['total_tax_rate_per_category_and_region'] = $xpath->query("//ns:total_tax_rate_per_category_and_region")->item(0)->nodeValue;
        $elements['total_tax_amount'] = $xpath->query("//ns:total_tax_amount")->item(0)->nodeValue;
        $invoiceitems = $xpath->query("//ns:invoice_item");

        foreach ($invoiceitems as $item) {
            $elements['invoice_item'][] = [
                'invoice_id' => $xpath->query("./ns:invoice_id ", $item)->item(0)->nodeValue,
                'invoice_item_id' => $xpath->query("./ns:invoice_item_id", $item)->item(0)->nodeValue,
                'service_name' => $xpath->query("./ns:service_name", $item)->item(0)->nodeValue,
                'service_units' => $xpath->query("./ns:service_units", $item)->item(0)->nodeValue,
                'service_extended_price' => $xpath->query("./ns:service_extended_price", $item)->item(0)->nodeValue,
            ];
        }
        return $elements;
    }
}
