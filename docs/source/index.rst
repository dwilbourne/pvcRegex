
.. toctree::
   :hidden:

   install
   usage

===============
pvcRegex Overview
===============

The pvcRegex package is a simple wrapper for commonly used PCRE functions.  Of course, wrapping these functions into
an object allows us to create reusable child classes that do specific things.  For example, the library comes with
regexes to validate true / false identifiers that are in text, validate simple numbers, windows filenames, etc.


Design Points
#############

* It provides a convenient way of storing regexes for future reusability.

* Incorporates a label for each regex that can be useful in creating a message after the metch method is run.
  
* Provides static methods for a couple of common tasks such as validating a regex and properly escaping a regex
string that was generated at runtime.



