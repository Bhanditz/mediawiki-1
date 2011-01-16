<?php

class PreprocessorTest extends MediaWikiTestCase {
	var $mTitle = 'Page title';
	var $mPPNodeCount = 0;
	var $mOptions;

	function setUp() {
		global $wgParserConf;
		$this->mOptions = new ParserOptions();
		$name = isset( $wgParserConf['preprocessorClass'] ) ? $wgParserConf['preprocessorClass'] : 'Preprocessor_DOM';

		$this->mPreprocessor = new $name( $this );
	}

	function getStripList() {
		return array( 'gallery' );
	}

	function provideCases() {
		return array(
			array( "Foo", "<root>Foo</root>" ),
			array( "<!-- Foo -->", "<root><comment>&lt;!-- Foo --&gt;</comment></root>" ),
			array( "<!-- Foo --><!-- Bar -->", "<root><comment>&lt;!-- Foo --&gt;</comment><comment>&lt;!-- Bar --&gt;</comment></root>" ),
			array( "<!-- Foo -->  <!-- Bar -->", "<root><comment>&lt;!-- Foo --&gt;</comment>  <comment>&lt;!-- Bar --&gt;</comment></root>" ),
			array( "<!-- Foo --> \n <!-- Bar -->", "<root><comment>&lt;!-- Foo --&gt;</comment> \n <comment>&lt;!-- Bar --&gt;</comment></root>" ),
			array( "<!-- Foo --> \n <!-- Bar -->\n", "<root><comment>&lt;!-- Foo --&gt;</comment> \n<comment> &lt;!-- Bar --&gt;\n</comment></root>" ),
			array( "<!-- Foo -->  <!-- Bar -->\n", "<root><comment>&lt;!-- Foo --&gt;</comment>  <comment>&lt;!-- Bar --&gt;</comment>\n</root>" ),
			array( "<!-->Bar", "<root><comment>&lt;!--&gt;Bar</comment></root>" ),
			array( "<!-- Comment -- comment", "<root><comment>&lt;!-- Comment -- comment</comment></root>" ),
			array( "== Foo ==\n  <!-- Bar -->\n== Baz ==\n", "<root><h level=\"2\" i=\"1\">== Foo ==</h>\n<comment>  &lt;!-- Bar --&gt;\n</comment><h level=\"2\" i=\"2\">== Baz ==</h>\n</root>" ),
			array( "<gallery/>", "<root><ext><name>gallery</name><attr></attr></ext></root>" ),
			array( "Foo <gallery/> Bar", "<root>Foo <ext><name>gallery</name><attr></attr></ext> Bar</root>" ),
			array( "<gallery></gallery>", "<root><ext><name>gallery</name><attr></attr><inner></inner><close>&lt;/gallery&gt;</close></ext></root>" ),
			array( "<foo> <gallery></gallery>", "<root>&lt;foo&gt; <ext><name>gallery</name><attr></attr><inner></inner><close>&lt;/gallery&gt;</close></ext></root>" ),
			array( "<foo> <gallery><gallery></gallery>", "<root>&lt;foo&gt; <ext><name>gallery</name><attr></attr><inner>&lt;gallery&gt;</inner><close>&lt;/gallery&gt;</close></ext></root>" ),
			array( "<noinclude> Foo bar </noinclude>", "<root><ignore>&lt;noinclude&gt;</ignore> Foo bar <ignore>&lt;/noinclude&gt;</ignore></root>" ),
			array( "<gallery>foo bar", "<root><ext><name>gallery</name><attr></attr><inner>foo bar</inner></ext></root>" ),
			array( "<gallery></gallery</gallery>", "<root><ext><name>gallery</name><attr></attr><inner>&lt;/gallery</inner><close>&lt;/gallery&gt;</close></ext></root>" ),
			array( "=== Foo === ", "<root><h level=\"3\" i=\"1\">=== Foo === </h></root>" ),
			array( "==<!-- -->= Foo === ", "<root><h level=\"2\" i=\"1\">==<comment>&lt;!-- --&gt;</comment>= Foo === </h></root>" ),
			array( "=== Foo ==<!-- -->= ", "<root><h level=\"1\" i=\"1\">=== Foo ==<comment>&lt;!-- --&gt;</comment>= </h></root>" ),
			array( "=== Foo ===<!-- -->\n", "<root><h level=\"3\" i=\"1\">=== Foo ===<comment>&lt;!-- --&gt;</comment></h>\n</root>" ),
			array( "=== Foo ===<!-- --> <!-- -->\n", "<root><h level=\"3\" i=\"1\">=== Foo ===<comment>&lt;!-- --&gt;</comment> <comment>&lt;!-- --&gt;</comment></h>\n</root>" ),
			array( "== Foo ==\n== Bar == \n", "<root><h level=\"2\" i=\"1\">== Foo ==</h>\n<h level=\"2\" i=\"2\">== Bar == </h>\n</root>" ),
			array( "===========", "<root><h level=\"5\" i=\"1\">===========</h></root>" ),
			array( "Foo\n=\n==\n=\n", "<root>Foo\n=\n==\n=\n</root>" ), 
			array( "{{Foo}}", "<root><template><title>Foo</title></template></root>" ),
			array( "\n{{Foo}}", "<root>\n<template lineStart=\"1\"><title>Foo</title></template></root>" ),
			array( "{{Foo|bar}}", "<root><template><title>Foo</title><part><name index=\"1\" /><value>bar</value></part></template></root>" ),  
			array( "{{Foo|bar}}a", "<root><template><title>Foo</title><part><name index=\"1\" /><value>bar</value></part></template>a</root>" ),  
			array( "{{Foo|bar|baz}}", "<root><template><title>Foo</title><part><name index=\"1\" /><value>bar</value></part><part><name index=\"2\" /><value>baz</value></part></template></root>" ),  
			array( "{{Foo|1=bar}}", "<root><template><title>Foo</title><part><name>1</name>=<value>bar</value></part></template></root>" ),
			array( "{{Foo|bar=baz}}", "<root><template><title>Foo</title><part><name>bar</name>=<value>baz</value></part></template></root>" ), 
			array( "{{Foo|1=bar|baz}}", "<root><template><title>Foo</title><part><name>1</name>=<value>bar</value></part><part><name index=\"1\" /><value>baz</value></part></template></root>" ), 
			array( "{{Foo|bar|foo=baz}}", "<root><template><title>Foo</title><part><name index=\"1\" /><value>bar</value></part><part><name>foo</name>=<value>baz</value></part></template></root>" ), 
			array( "{{{1}}}", "<root><tplarg><title>1</title></tplarg></root>" ),
			array( "{{{1|}}}", "<root><tplarg><title>1</title><part><name index=\"1\" /><value></value></part></tplarg></root>" ),
			array( "{{{Foo}}}", "<root><tplarg><title>Foo</title></tplarg></root>" ),
			array( "{{{Foo|}}}", "<root><tplarg><title>Foo</title><part><name index=\"1\" /><value></value></part></tplarg></root>" ),
			array( "{{{Foo|bar|baz}}}", "<root><tplarg><title>Foo</title><part><name index=\"1\" /><value>bar</value></part><part><name index=\"2\" /><value>baz</value></part></tplarg></root>" ),
			array( "{<!-- -->{Foo}}", "<root>{<comment>&lt;!-- --&gt;</comment>{Foo}}</root>" ),
			array( "{{{{Foobar}}}}", "<root>{<tplarg><title>Foobar</title></tplarg>}</root>" ),  
			array( "{{{{{Foo}}}}}", "<root><template><title><tplarg><title>Foo</title></tplarg></title></template></root>" ),
			array( "{{{{{Foo}} }}}", "<root><tplarg><title><template><title>Foo</title></template> </title></tplarg></root>" ),
			array( "{{{{{{Foo}}}}}}", "<root><tplarg><title><tplarg><title>Foo</title></tplarg></title></tplarg></root>" ),
			array( "{{{{{{Foo}}}}}", "<root>{<template><title><tplarg><title>Foo</title></tplarg></title></template></root>" ),
			array( "[[[Foo]]", "<root>[[[Foo]]</root>" ),
			array( "{{Foo|[[[[bar]]|baz]]}}", "<root><template><title>Foo</title><part><name index=\"1\" /><value>[[[[bar]]|baz]]</value></part></template></root>" ), /* This test is important, since it means the difference between having the [[ rule stacked or not */
			array( "{{Foo|[[[[bar]|baz]]}}", "<root>{{Foo|[[[[bar]|baz]]}}</root>" ),
			/* array( file_get_contents( dirname( __FILE__ ) . '/QuoteQuran.txt' ), file_get_contents( dirname( __FILE__ ) . '/QuoteQuranExpanded.txt' ) ), */
		);
	}

	/**
	 * @dataProvider provideCases
	 */
	function testPreprocessorOutput( $wikiText, $expectedXml ) {
		$this->assertEquals( $expectedXml, $this->mPreprocessor->preprocessToXml( $wikiText ) );
	}

}

