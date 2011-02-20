=======================
Fight simulator for DSO
=======================

This is a fight simulator and unit set optimizer for `"Die Siedler Online"`__.
It simulates the fights according to the published rules and displays the
expected losses.

__ http://www.diesiedleronline.de/

To simulate a simple fight use the ``fight`` command line tool::

    $ ./fight 40R20B 30SL
    Won fight with 24.2 units lost:

       - Rekrut              :   15.80 of  40 ( 12 -  18) ( -24.20)
       - Bogenschütze        :   20.00 of  20 ( 20 -  20) (   0.00)

      versus (2.0 rounds (2 - 2))

       - Schläger            :    0.00 of  30 (  0 -   0) ( -30.00)


Additionally this software allows you to select the optimal army from a set of
units you have available. The ``--optimze`` option can be used for that::

    $ ./fight --optimize 134R42M111B23LB64C 150WL50WH
    Evaluated 43 different armies

    Won fight with 140.2 units lost:

       - Reiterei            :    0.00 of  24 (  0 -   0) ( -24.00)
       - Rekrut              :   17.80 of 134 ( 13 -  24) (-116.20)
       - Miliz               :   42.00 of  42 ( 42 -  42) (   0.00)
       - Bogenschütze        :    0.00 of   0 (  0 -   0) (   0.00)
       - Langbogenschütze    :    0.00 of   0 (  0 -   0) (   0.00)

      versus (2.0 rounds (2 - 2))

       - Wachhund            :    0.00 of  50 (  0 -   0) ( -50.00)
       - Waldläufer          :    0.00 of 150 (  0 -   0) (-150.00)

    Won fight with 141.1 units lost:

       - Reiterei            :    0.00 of   0 (  0 -   0) (   0.00)
       - Rekrut              :    0.00 of 134 (  0 -   0) (-134.00)
       - Miliz               :   34.90 of  42 ( 32 -  41) (  -7.10)
       - Bogenschütze        :    0.00 of   0 (  0 -   0) (   0.00)
       - Langbogenschütze    :    0.00 of   0 (  0 -   0) (   0.00)

      versus (2.0 rounds (2 - 2))

       - Wachhund            :    0.00 of  50 (  0 -   0) ( -50.00)
       - Waldläufer          :    0.00 of 150 (  0 -   0) (-150.00)

    Won fight with 147 units lost:

       - Reiterei            :   14.00 of  64 ( 14 -  14) ( -50.00)
       - Rekrut              :   37.00 of 134 ( 33 -  42) ( -97.00)
       - Miliz               :    0.00 of   0 (  0 -   0) (   0.00)
       - Bogenschütze        :    0.00 of   0 (  0 -   0) (   0.00)
       - Langbogenschütze    :    0.00 of   0 (  0 -   0) (   0.00)

      versus (2.0 rounds (2 - 2))

       - Wachhund            :    0.00 of  50 (  0 -   0) ( -50.00)
       - Waldläufer          :    0.00 of 150 (  0 -   0) (-150.00)

Abbreviations
=============

The abbreviations for the units are the common ones, as documented here:
http://www.siedlertools.de/wiki/Kampfsystem You can also get a list of the used
abbreviatiosn by calling `./fight --list`.

Prerequisites
=============

You need PHP 5.3 available in your path to run this software.


..
   Local Variables:
   mode: rst
   fill-column: 79
   End: 
   vim: et syn=rst tw=79
