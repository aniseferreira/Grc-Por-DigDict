function searchChange(obj)
{
   var text = obj.value;
   if (text.substr(text.length - 1, 1) != "*" && text.substr(text.length - 1, 1) != "," && text.substr(text.length - 1, 1) != " ")
   {
		text = text
			.replace(/!\)\/a|\)!\/a|!\/\)a|\)\/!a|\/!\)a|\/\)!a/g, 'ᾄ')
			.replace(/!\(\/a|\(!\/a|!\/\(a|\(\/!a|\/!\(a|\/\(!a/g, 'ᾅ')
			.replace(/!\)\\a|\)!\\a|!\\\)a|\)\\!a|\\!\)a|\\\)!a/g, 'ᾂ')
			.replace(/!\(\\a|\(!\\a|!\\\(a|\(\\!a|\\!\(a|\\\(!a/g, 'ᾃ')
			.replace(/!\)=a|\)!=a|!=\)a|\)=!a|=!\)a|=\)!a/g, 'ᾆ')
			.replace(/!\(=a|\(!=a|!=\(a|\(=!a|=!\(a|=\(!a/g, 'ᾇ')
			.replace(/\)\/a|\/\)a/g, 'ἄ')
			.replace(/\(\/a|\/\(a/g, 'ἅ')
			.replace(/\)\\a|\\\)a/g, 'ἂ')
			.replace(/\(\\a|\\\(a/g, 'ἃ')
			.replace(/\)=a|=\)a/g, 'ἆ')
			.replace(/\(=a|=\(a/g, 'ἇ')
			.replace(/!\)a|\)!a/g, 'ᾀ')
			.replace(/!\(a|\(!a/g, 'ᾁ')
			.replace(/\/a/g, 'ά')
			.replace(/\\a/g, 'ὰ')
			.replace(/=a/g, 'ᾶ')
			.replace(/\)a/g, 'ἀ')
			.replace(/\(a/g, 'ἁ')
			.replace(/!a/g, 'ᾳ')
			.replace(/a/g, 'α')
			.replace(/!\)\/A|\)!\/A|!\/\)A|\)\/!A|\/!\)A|\/\)!A/g, 'ᾌ')
			.replace(/!\(\/A|\(!\/A|!\/\(A|\(\/!A|\/!\(A|\/\(!A/g, 'ᾍ')
			.replace(/!\)\\A|\)!\\A|!\\\)A|\)\\!A|\\!\)A|\\\)!A/g, 'ᾊ')
			.replace(/!\(\\A|\(!\\A|!\\\(A|\(\\!A|\\!\(A|\\\(!A/g, 'ᾋ')
			.replace(/!\)=A|\)!=A|!=\)A|\)=!A|=!\)A|=\)!A/g, 'ᾎ')
			.replace(/!\(=A|\(!=A|!=\(A|\(=!A|=!\(A|=\(!A/g, 'ᾏ')
			.replace(/\)\/A|\/\)A/g, 'Ἄ')
			.replace(/\(\/A|\/\(A/g, 'Ἅ')
			.replace(/\)\\A|\\\)A/g, 'Ἂ')
			.replace(/\(\\A|\\\(A/g, 'Ἃ')
			.replace(/\)=A|=\)A/g, 'Ἆ')
			.replace(/\(=A|=\(A/g, 'Ἇ')
			.replace(/!\)A|\)!A/g, 'ᾈ')
			.replace(/!\(A|\(!A/g, 'ᾉ')
			.replace(/\/A/g, 'Ά')
			.replace(/\\A/g, 'Ὰ')
			.replace(/\)A/g, 'Ἀ')
			.replace(/\(A/g, 'Ἁ')
			.replace(/!A/g, 'ᾼ')
			.replace(/b/g, 'β')
			.replace(/B/g, 'Β')
			.replace(/g/g, 'γ')
			.replace(/G/g, 'Γ')
			.replace(/d/g, 'δ')
			.replace(/D/g, 'Δ')
			.replace(/\)\/e|\/\)e/g, 'ἔ')
			.replace(/\(\/e|\/\(e/g, 'ἕ')
			.replace(/\)\\e|\\\)e/g, 'ἒ')
			.replace(/\(\\e|\\\(e/g, 'ἓ')
			.replace(/\/e/g, 'έ')
			.replace(/\\e/g, 'ὲ')
			.replace(/\)e/g, 'ἐ')
			.replace(/\(e/g, 'ἑ')
			.replace(/e/g, 'ε')
			.replace(/\)\/E|\/\)E/g, 'Ἔ')
			.replace(/\(\/E|\/\(E/g, 'Ἕ')
			.replace(/\)\\E|\\\)E/g, 'Ἒ')
			.replace(/\(\\E|\\\(E/g, 'Ἓ')
			.replace(/\/E/g, 'Έ')
			.replace(/\\E/g, 'Ὲ')
			.replace(/\)E/g, 'Ἐ')
			.replace(/\(E/g, 'Ἑ')
			.replace(/E/g, 'Ε')
			.replace(/z/g, 'ζ')
			.replace(/Z/g, 'Ζ')
			.replace(/!\)\/h|\)!\/h|!\/\)h|\)\/!h|\/!\)h|\/\)!h/g, 'ᾔ')
			.replace(/!\(\/h|\(!\/h|!\/\(h|\(\/!h|\/!\(h|\/\(!h/g, 'ᾕ')
			.replace(/!\)\\h|\)!\\h|!\\\)h|\)\\!h|\\!\)h|\\\)!h/g, 'ᾒ')
			.replace(/!\(\\h|\(!\\h|!\\\(h|\(\\!h|\\!\(h|\\\(!h/g, 'ᾓ')
			.replace(/!\)=h|\)!=h|!=\)h|\)=!h|=!\)h|=\)!h/g, 'ᾖ')
			.replace(/!\(=h|\(!=h|!=\(h|\(=!h|=!\(h|=\(!h/g, 'ᾗ')
			.replace(/\)\/h|\/\)h/g, 'ἤ')
			.replace(/\(\/h|\/\(h/g, 'ἥ')
			.replace(/\)\\h|\\\)h/g, 'ἢ')
			.replace(/\(\\h|\\\(h/g, 'ἣ')
			.replace(/\)=h|=\)h/g, 'ἦ')
			.replace(/\(=h|=\(h/g, 'ἧ')
			.replace(/!\)h|\)!h/g, 'ᾐ')
			.replace(/!\(h|\(!h/g, 'ᾑ')
			.replace(/\/h/g, 'ή')
			.replace(/\\h/g, 'ὴ')
			.replace(/=h/g, 'ῆ')
			.replace(/\)h/g, 'ἠ')
			.replace(/\(h/g, 'ἡ')
			.replace(/!h/g, 'ῃ')
			.replace(/h/g, 'η')
			.replace(/!\)\/H|\)!\/H|!\/\)H|\)\/!H|\/!\)H|\/\)!H/g, 'ᾜ')
			.replace(/!\(\/H|\(!\/H|!\/\(H|\(\/!H|\/!\(H|\/\(!H/g, 'ᾝ')
			.replace(/!\)\\H|\)!\\H|!\\\)H|\)\\!H|\\!\)H|\\\)!H/g, 'ᾚ')
			.replace(/!\(\\H|\(!\\H|!\\\(H|\(\\!H|\\!\(H|\\\(!H/g, 'ᾛ')
			.replace(/!\)=H|\)!=H|!=\)H|\)=!H|=!\)H|=\)!H/g, 'ᾞ')
			.replace(/!\(=H|\(!=H|!=\(H|\(=!H|=!\(H|=\(!H/g, 'ᾟ')
			.replace(/\)\/H|\/\)H/g, 'Ἤ')
			.replace(/\(\/H|\/\(H/g, 'Ἥ')
			.replace(/\)\\H|\\\)H/g, 'Ἢ')
			.replace(/\(\\H|\\\(H/g, 'Ἣ')
			.replace(/\)=H|=\)H/g, 'Ἦ')
			.replace(/\(=H|=\(H/g, 'Ἧ')
			.replace(/!\)H|\)!H/g, 'ᾘ')
			.replace(/!\(H|\(!H/g, 'ᾙ')
			.replace(/\/H/g, 'Ή')
			.replace(/\\H/g, 'Ὴ')
			.replace(/\)H/g, 'Ἠ')
			.replace(/\(H/g, 'Ἡ')
			.replace(/!H/g, 'ῌ')
			.replace(/H/g, 'Η')
			.replace(/q/g, 'θ')
			.replace(/Q/g, 'Θ')
			.replace(/\)\/i|\/\)i/g, 'ἴ')
			.replace(/\(\/i|\/\(i/g, 'ἵ')
			.replace(/\)\\i|\\\)i/g, 'ἲ')
			.replace(/\(\\i|\\\(i/g, 'ἳ')
			.replace(/=\)i|\)=i/g, 'ἶ')
			.replace(/=\(i|\(=i/g, 'ἷ')
			.replace(/\+\/i/g, 'ΐ')
			.replace(/\+i/g, 'ϊ')
			.replace(/\/i/g, 'ί')
			.replace(/\\i/g, 'ὶ')
			.replace(/=i/g, 'ῖ')
			.replace(/\)i/g, 'ἰ')
			.replace(/\(i/g, 'ἱ')
			.replace(/i/g, 'ι')
			.replace(/\)\/I|\/\)I/g, 'Ἴ')
			.replace(/\(\/I|\/\(I/g, 'Ἵ')
			.replace(/\)\\I|\\\)I/g, 'Ἲ')
			.replace(/\(\\I|\\\(I/g, 'Ἳ')
			.replace(/=\)I|\)=I/g, 'Ἶ')
			.replace(/=\(I|\(=I/g, 'Ἷ')
			.replace(/\/I/g, 'Ί')
			.replace(/\\I/g, 'Ὶ')
			.replace(/\)I/g, 'Ἰ')
			.replace(/\(I/g, 'Ἱ')
			.replace(/I/g, 'Ι')
			.replace(/k/g, 'κ')
			.replace(/K/g, 'Κ')
			.replace(/l/g, 'λ')
			.replace(/L/g, 'Λ')
			.replace(/m/g, 'μ')
			.replace(/M/g, 'Μ')
			.replace(/n/g, 'ν')
			.replace(/N/g, 'Ν')
			.replace(/v/g, 'ν')
			.replace(/V/g, 'Ν')
			.replace(/c/g, 'ξ')
			.replace(/C/g, 'Ξ')
			.replace(/\)\/o|\/\)o/g, 'ὄ')
			.replace(/\(\/o|\/\(o/g, 'ὅ')
			.replace(/\)\\o|\\\)o/g, 'ὂ')
			.replace(/\(\\o|\\\(o/g, 'ὃ')
			.replace(/\/o/g, 'ό')
			.replace(/\\o/g, 'ὸ')
			.replace(/\)o/g, 'ὀ')
			.replace(/\(o/g, 'ὁ')
			.replace(/o/g, 'ο')
			.replace(/\)\/O|\/\)O/g, 'Ὄ')
			.replace(/\(\/O|\/\(O/g, 'Ὅ')
			.replace(/\)\\O|\\\)O/g, 'Ὂ')
			.replace(/\(\\O|\\\(O/g, 'Ὃ')
			.replace(/\/O/g, 'Ό')
			.replace(/\\O/g, 'Ὸ')
			.replace(/\)O/g, 'Ὀ')
			.replace(/\(O/g, 'Ὁ')
			.replace(/O/g, 'Ο')
			.replace(/p/g, 'π')
			.replace(/P/g, 'Π')
			.replace(/r/g, 'ρ')
			.replace(/R/g, 'Ρ')
			.replace(/s/g, 'ς')
			.replace(/S/g, 'Σ')
			.replace(/t/g, 'τ')
			.replace(/T/g, 'Τ')
			.replace(/\)\/u|\/\)u/g, 'ὔ')
			.replace(/\(\/u|\/\(u/g, 'ὕ')
			.replace(/\)\\u|\\\)u/g, 'ὒ')
			.replace(/\(\\u|\\\(u/g, 'ὓ')
			.replace(/=\)u|\)=u/g, 'ὖ')
			.replace(/=\(u|\(=u/g, 'ὗ')
			.replace(/\)\/u|\/\)u/g, 'ὔ')
			.replace(/\(\/u|\/\(u/g, 'ὕ')
			.replace(/\)\\u|\\\)u/g, 'ὒ')
			.replace(/\(\\u|\\\(u/g, 'ὓ')
			.replace(/\+\/u/g, 'ΰ')
			.replace(/\+u/g, 'ϋ')
			.replace(/=\)u|\)=u/g, 'ὖ')
			.replace(/=\(u|\(=u/g, 'ὗ')
			.replace(/\)\/y|\/\)y/g, 'ὔ')
			.replace(/\(\/y|\/\(y/g, 'ὕ')
			.replace(/\)\\y|\\\)y/g, 'ὒ')
			.replace(/\(\\y|\\\(y/g, 'ὓ')
			.replace(/=\)y|\)=y/g, 'ὖ')
			.replace(/=\(y|\(=y/g, 'ὗ')
			.replace(/\/y/g, 'ύ')
			.replace(/\\y/g, 'ὺ')
			.replace(/=y/g, 'ῦ')
			.replace(/\)y/g, 'ὐ')
			.replace(/\(y/g, 'ὑ')
			.replace(/\/u/g, 'ύ')
			.replace(/\\u/g, 'ὺ')
			.replace(/=u/g, 'ῦ')
			.replace(/\)u/g, 'ὐ')
			.replace(/\(u/g, 'ὑ')
			.replace(/u|y/g, 'υ')
			.replace(/\(\/Y|\/\(Y/g, 'Ὕ')
			.replace(/\(\\Y|\\\(Y/g, 'Ὓ')
			.replace(/=\(Y|\(=Y/g, 'Ὗ')
			.replace(/\(\/U|\/\(U/g, 'Ὕ')
			.replace(/\(\\U|\\\(U/g, 'Ὓ')
			.replace(/=\(U|\(=U/g, 'Ὗ')
			.replace(/\/Y/g, 'Ύ')
			.replace(/\\Y/g, 'Ὺ')
			.replace(/\(Y/g, 'Ὑ')
			.replace(/\/U/g, 'Ύ')
			.replace(/\\U/g, 'Ὺ')
			.replace(/\(U/g, 'Ὑ')
			.replace(/U/g, 'Υ')
			.replace(/Y/g, 'Υ')
			.replace(/f/g, 'φ')
			.replace(/F/g, 'Φ')
			.replace(/x/g, 'χ')
			.replace(/X/g, 'Χ')
			.replace(/j/g, 'ψ')
			.replace(/J/g, 'Ψ')
			.replace(/!\)\/w|\)!\/w|!\/\)w|\)\/!w|\/!\)w|\/\)!w/g, 'ᾤ')
			.replace(/!\(\/w|\(!\/w|!\/\(w|\(\/!w|\/!\(w|\/\(!w/g, 'ᾥ')
			.replace(/!\)\\w|\)!\\w|!\\\)w|\)\\!w|\\!\)w|\\\)!w/g, 'ᾢ')
			.replace(/!\(\\w|\(!\\w|!\\\(w|\(\\!w|\\!\(w|\\\(!w/g, 'ᾣ')
			.replace(/!\)=w|\)!=w|!=\)w|\)=!w|=!\)w|=\)!w/g, 'ᾦ')
			.replace(/!\(=w|\(!=w|!=\(w|\(=!w|=!\(w|=\(!w/g, 'ᾧ')
			.replace(/!\)\/ô|\)!\/ô|!\/\)ô|\)\/!ô|\/!\)ô|\/\)!ô/g, 'ᾤ')
			.replace(/!\(\/ô|\(!\/ô|!\/\(ô|\(\/!ô|\/!\(ô|\/\(!ô/g, 'ᾥ')
			.replace(/!\)\\ô|\)!\\ô|!\\\)ô|\)\\!ô|\\!\)ô|\\\)!ô/g, 'ᾢ')
			.replace(/!\(\\ô|\(!\\ô|!\\\(ô|\(\\!ô|\\!\(ô|\\\(!ô/g, 'ᾣ')
			.replace(/!\)=ô|\)!=ô|!=\)ô|\)=!ô|=!\)ô|=\)!ô/g, 'ᾦ')
			.replace(/!\(=ô|\(!=ô|!=\(ô|\(=!ô|=!\(ô|=\(!ô/g, 'ᾧ')
			.replace(/\)\/w|\/\)w/g, 'ὤ')
			.replace(/\(\/w|\/\(w/g, 'ὥ')
			.replace(/\)\\w|\\\)w/g, 'ὢ')
			.replace(/\(\\w|\\\(w/g, 'ὣ')
			.replace(/!=w|=!w/g, 'ῷ')
			.replace(/\)=w|=\)w/g, 'ὦ')
			.replace(/\(=w|=\(w/g, 'ὧ')
			.replace(/!\)w|\)!w/g, 'ᾠ')
			.replace(/!\(w|\(!w/g, 'ᾡ')
			.replace(/\)\/ô|\/\)ô/g, 'ὤ')
			.replace(/\(\/ô|\/\(ô/g, 'ὥ')
			.replace(/\)\\ô|\\\)ô/g, 'ὢ')
			.replace(/\(\\ô|\\\(ô/g, 'ὣ')
			.replace(/\)=ô|=\)ô/g, 'ὦ')
			.replace(/\(=ô|=\(ô/g, 'ὧ')
			.replace(/!\)ô|\)!ô/g, 'ᾠ')
			.replace(/!\(ô|\(!ô/g, 'ᾡ')
			.replace(/\/w/g, 'ώ')
			.replace(/\\w/g, 'ὼ')
			.replace(/=w/g, 'ῶ')
			.replace(/\)w/g, 'ὠ')
			.replace(/\(w/g, 'ὡ')
			.replace(/!w/g, 'ῳ')
			.replace(/\/ô/g, 'ώ')
			.replace(/\\ô/g, 'ὼ')
			.replace(/=ô/g, 'ῶ')
			.replace(/\)ô/g, 'ὠ')
			.replace(/\(ô/g, 'ὡ')
			.replace(/!ô/g, 'ῳ')
			.replace(/w/g, 'ω')
			.replace(/!\)\/W|\)!\/W|!\/\)W|\)\/!W|\/!\)W|\/\)!W/g, 'ᾬ')
			.replace(/!\(\/W|\(!\/W|!\/\(W|\(\/!W|\/!\(W|\/\(!W/g, 'ᾭ')
			.replace(/!\)\\W|\)!\\W|!\\\)W|\)\\!W|\\!\)W|\\\)!W/g, 'ᾪ')
			.replace(/!\(\\W|\(!\\W|!\\\(W|\(\\!W|\\!\(W|\\\(!W/g, 'ᾫ')
			.replace(/!\)=W|\)!=W|!=\)W|\)=!W|=!\)W|=\)!W/g, 'ᾮ')
			.replace(/!\(=W|\(!=W|!=\(W|\(=!W|=!\(W|=\(!W/g, 'ᾯ')
			.replace(/\)\/W|\/\)W/g, 'Ὤ')
			.replace(/\(\/W|\/\(W/g, 'Ὥ')
			.replace(/\)\\W|\\\)W/g, 'Ὢ')
			.replace(/\(\\W|\\\(W/g, 'Ὣ')
			.replace(/\)=W|=\)W/g, 'Ὦ')
			.replace(/\(=W|=\(W/g, 'Ὧ')
			.replace(/!\)W|\)!W/g, 'ᾨ')
			.replace(/!\(W|\(!W/g, 'ᾩ')
			.replace(/\/W/g, 'Ώ')
			.replace(/\\W/g, 'Ὼ')
			.replace(/\)W/g, 'Ὠ')
			.replace(/\(W/g, 'Ὡ')
			.replace(/!W/g, 'ῼ')
			.replace(/^ϐ/, 'β')
			.replace(/^ρ/, 'ῥ')
			.replace(/^Ρ/, 'Ῥ')
			.replace(/ς(?=.)/, 'σ')
			.replace(/σ /, 'ς ')
			.replace(/σ,/, 'ς,');
			
	}
   obj.value = text;
}
