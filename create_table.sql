# Creates the compositions table required in MySQL for this API to function.
# Author: Dylan McKee
# Date: 28/02/2016

# We can store the composition content as text because it is just raw XML in text, not binary data, so there's no need to use the blob type.

CREATE TABLE `compositions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `composition_content` text NOT NULL,
  PRIMARY KEY (`id`)
);
