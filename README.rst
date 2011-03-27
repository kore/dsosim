=======================
Fight simulator for DSO
=======================

This is a fight simulator and unit set optimizer for `"Die Siedler Online"`__.
It simulates the fights according to the published rules and displays the
expected losses.

__ http://www.diesiedleronline.de/

To simulate a simple fight use the ``fight`` command line tool::

    $ ./fight 40R20B 30SL
    Won fight with 22 units lost: (average of 10 evaluations)

       - General             :   1.00 (  1 -   1) of   1 ( -0.00)
       - Rekrut              :  18.00 ( 16 -  20) of  40 (-22.00)
       - Bogenschütze        :  20.00 ( 20 -  20) of  20 (  0.00)

      versus (2.0 rounds (2 - 2))

       - Schläger            :   0.00 (  0 -   0) of  30 (-30.00)

Additionally this software allows you to select the optimal army from a set of
units you have available. The ``--optimze`` option can be used for that::

    $ ./fight --optimize --values unit_values.txt 134R42M111B23LB64C 150WL50WH
    Starting fight.

    Getting army variations:
    - Removing groups of units from army: 206 armies created.
    - Capping army size 206 / 206 (100.00%)       
    - Removing duplicate armies: 43 of 336 armies left.

    Fight 43 / 43 (100.00%) (67.44% fights won)       

    Fights finished - the results:

    Evaluated 43 different armies

    Won fight with 133.3 units lost: (average of 10 evaluations)

       - Rekrut              :   1.70 (  0 -   6) of 134 (-132.30)
       - Miliz               :  41.00 ( 38 -  42) of  42 ( -1.00)
       - General             :   1.00 (  1 -   1) of   1 ( -0.00)

      versus (2.0 rounds (2 - 2))

       - Wachhund            :   0.00 (  0 -   0) of  50 (-50.00)
       - Waldläufer          :   0.00 (  0 -   0) of 150 (-150.00)

    Won fight with 144.6 units lost: (average of 10 evaluations)

       - Rekrut              :  13.40 (  5 -  19) of 134 (-120.60)
       - Miliz               :  42.00 ( 42 -  42) of  42 (  0.00)
       - Bogenschütze        :   0.00 (  0 -   0) of  24 (-24.00)
       - General             :   1.00 (  1 -   1) of   1 ( -0.00)

      versus (2.0 rounds (2 - 2))

       - Wachhund            :   0.00 (  0 -   0) of  50 (-50.00)
       - Waldläufer          :   0.00 (  0 -   0) of 150 (-150.00)

    Won fight with 137.7 units lost: (average of 10 evaluations)

       - Reiterei            :   0.00 (  0 -   0) of  24 (-24.00)
       - Rekrut              :  20.30 ( 15 -  27) of 134 (-113.70)
       - Miliz               :  42.00 ( 42 -  42) of  42 (  0.00)
       - General             :   1.00 (  1 -   1) of   1 ( -0.00)

      versus (1.0 rounds (1 - 1))

       - Wachhund            :   0.00 (  0 -   0) of  50 (-50.00)
       - Waldläufer          :   0.00 (  0 -   0) of 150 (-150.00)

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
