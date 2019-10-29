<?php

class HtmlView
{
	private $html;
	private $title = __CLASS__;
	private $favicon;

	private $headMeta;
	private $headStyle;
	private $headScript;

	//includes
	private $headIncludeStyle;
	private $headIncludeScript;

	private $body;

	function __toHtml() {
		$this->html  = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">'.PHP_EOL;
		$this->html .= '<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml" lang="pt-br">';
		$this->html .= '<head>';
		$this->html .= '<title>'. $this->title .'</title>';

		if ($this->favicon)
			$this->html .= $this->favicon->__toHtml();

		if ($this->headMeta)
			$this->html .= $this->headMeta->__toHtml();

		if ($this->headStyle)
			$this->html .= $this->headStyle;//->__toHtml();

		if ($this->headScript)
			$this->html .= $this->headScript->__toHtml();

		if ($this->headIncludeStyle)
			$this->html .= $this->headIncludeStyle->__toHtml();

		if ($this->headIncludeScript)
			$this->html .= $this->headIncludeScript->__toHtml();


		$this->html .= '</head>';
		$this->html .= '<body>';

		if ($this->body)
			$this->html .= $this->body->__toHtml();
		else
			$this->html .= '<h1>' . __CLASS__ . '</h1>';

		$this->html .= '</body>';
		$this->html .= '</html>';
	}

	function write() {
		echo $this->html;
		flush();
	}

	final function set($k, $v) { /*Avoid wrong set*/ }

	final function setTitle($title) {
		$this->title = $title;
	}

	final function setFavicon( $favicon) {
		$this->favicon = $favicon;
	}

	final function setHeadMeta( $headMeta) {
		$this->headMeta = $headMeta;
	}

	final function setHeadStyle( $headStyle) {
		$this->headStyle = $headStyle;
	}

	final function setHeadScript( $headScript) {
		$this->headScript = $headScript;
	}

	final function setHeadIncludeStyle( $headIncludeStyle) {
		$this->headIncludeStyle = $headIncludeStyle;
	}

	final function setHeadIncludeScript( $headIncludeScript) {
		$this->headIncludeScript = $headIncludeScript;
	}

	final function setBody( $body) {
		$this->body = $body;
	}
}
