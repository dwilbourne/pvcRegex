=====
Usage
=====

To create a new regex, supply the Regex constructor with a pattern (including delimiters) and a label.  Once created,
you can use the getMatch and getMatches methods just as you would with the function-oriented versions of this code.
Also, the match method takes a second optional boolean parameter called "$matchAll".  When set to true, the behavior
is modified to use preg_match_all under the covers.

For example,::

    $pattern = '/foo/';
    $label = 'foostring';
    $regex = new Regex($pattern, $label);
    $result = $regex->match('some foo string');
    $fooMatch = $regex->getMatch[1];

The Regex object also has an attribute regarding case-sensitivity.  setCaseSensitive sets the value, isCaseSensitive
retrives the value.

There are three static methods in the class that can be useful. One is validatePattern, which returns a bool given a
pattern.  The other is escapeString.  Under the covers, this is preg_quote.  In my view, preg_quote is entirely
misnamed since it had nothing to do with quoting anything.  It escapes runtime-generated patterns.  See the
comments in the function definition of escapeString for more details.  The last is validateDelimiter.  The rules for
what constitutes a valid delimiter are not easy to remember, so you can use this as a diagnostic if you like.