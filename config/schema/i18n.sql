# Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
#
# Licensed under The MIT License
# For full copyright and license information, please see the LICENSE.txt
# Redistributions of files must retain the above copyright notice.
# MIT License (https://opensource.org/licenses/mit-license.php)

CREATE TABLE i18n (
    id SERIAL,
    locale varchar(6) NOT NULL,
    model varchar(255) NOT NULL,
    foreign_key int NOT NULL,
    field varchar(255) NOT NULL,
    content text,
    PRIMARY KEY (id)
);
CREATE UNIQUE INDEX I18N_LOCALE_FIELD
ON i18n (locale, model, foreign_key, field);
CREATE INDEX I18N_FIELD
ON i18n (model, foreign_key, field);
