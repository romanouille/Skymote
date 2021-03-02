CREATE EXTENSION pg_trgm;

CREATE TABLE "bgp_events" (
    "id" serial NOT NULL,
    "type" smallint NOT NULL,
    "version" smallint NOT NULL,
    "block" inet NOT NULL,
    "block_start" inet NOT NULL,
    "block_end" inet NOT NULL,
    "before" bigint DEFAULT '0' NOT NULL,
    "after" bigint DEFAULT '0' NOT NULL,
    "timestamp" bigint NOT NULL
) WITH (oids = false);

CREATE TABLE "bgp_routes" (
    "id" serial NOT NULL,
    "version" smallint NOT NULL,
    "block" inet NOT NULL,
    "block_start" inet NOT NULL,
    "block_end" inet NOT NULL,
    "origin" bigint NOT NULL,
    "timestamp" bigint NOT NULL
) WITH (oids = false);

CREATE TABLE "dump_as_0" (
    "id" serial NOT NULL,
    "name" text NOT NULL,
    "country" character(2) NOT NULL
) WITH (oids = false);

CREATE TABLE "dump_as_1" (
    "id" serial NOT NULL,
    "name" text NOT NULL,
    "country" character(2) NOT NULL
) WITH (oids = false);

CREATE TABLE "dump_blocks_0" (
    "id" serial NOT NULL,
    "version" smallint NOT NULL,
    "block" inet NOT NULL,
    "block_start" inet NOT NULL,
    "block_end" inet NOT NULL,
    "country" character(2) NOT NULL,
    "lir" bigint NOT NULL,
    "created" bigint NOT NULL,
    "rir" smallint NOT NULL
) WITH (oids = false);

CREATE TABLE "dump_blocks_1" (
    "id" serial NOT NULL,
    "version" smallint NOT NULL,
    "block" inet NOT NULL,
    "block_start" inet NOT NULL,
    "block_end" inet NOT NULL,
    "country" character(2) NOT NULL,
    "lir" bigint NOT NULL,
    "created" bigint NOT NULL,
    "rir" smallint NOT NULL
) WITH (oids = false);

CREATE TABLE "dump_lir_0" (
    "id" serial NOT NULL,
    "rir" smallint NOT NULL,
    "created" bigint NOT NULL
) WITH (oids = false);

CREATE TABLE "dump_lir_1" (
    "id" serial NOT NULL,
    "rir" smallint NOT NULL,
    "created" bigint NOT NULL
) WITH (oids = false);

CREATE TABLE "dump_ripe_allocations_0" (
    "id" serial NOT NULL,
    "version" smallint NOT NULL,
    "block" inet NOT NULL,
    "block_start" inet NOT NULL,
    "block_end" inet NOT NULL,
    "org" character(255) NOT NULL,
    "country" character(2) NOT NULL,
    "netname" text NOT NULL,
    "description" text NOT NULL,
    "remarks" text NOT NULL,
    "status" character(100) NOT NULL,
    "created" bigint NOT NULL,
    "modified" bigint NOT NULL
) WITH (oids = false);

CREATE TABLE "dump_ripe_allocations_1" (
    "id" serial NOT NULL,
    "version" smallint NOT NULL,
    "block" inet NOT NULL,
    "block_start" inet NOT NULL,
    "block_end" inet NOT NULL,
    "org" character(255) NOT NULL,
    "country" character(2) NOT NULL,
    "netname" text NOT NULL,
    "description" text NOT NULL,
    "remarks" text NOT NULL,
    "status" character(100) NOT NULL,
    "created" bigint NOT NULL,
    "modified" bigint NOT NULL
) WITH (oids = false);

CREATE TABLE "dump_ripe_as_0" (
    "id" serial NOT NULL,
    "org" character(255) NOT NULL,
    "sponsoring_org" character(255) NOT NULL,
    "description" text NOT NULL,
    "remarks" text NOT NULL,
    "created" bigint NOT NULL,
    "modified" bigint NOT NULL
) WITH (oids = false);

CREATE TABLE "dump_ripe_as_1" (
    "id" serial NOT NULL,
    "org" character(255) NOT NULL,
    "sponsoring_org" character(255) NOT NULL,
    "description" text NOT NULL,
    "remarks" text NOT NULL,
    "created" bigint NOT NULL,
    "modified" bigint NOT NULL
) WITH (oids = false);

CREATE TABLE "dump_ripe_as_peers_0" (
    "id" serial NOT NULL,
    "asn" bigint NOT NULL,
    "peer" bigint NOT NULL
) WITH (oids = false);

CREATE TABLE "dump_ripe_as_peers_1" (
    "id" serial NOT NULL,
    "asn" bigint NOT NULL,
    "peer" bigint NOT NULL
) WITH (oids = false);

CREATE TABLE "dump_ripe_organisations_0" (
    "id" serial NOT NULL,
    "org" character(255) NOT NULL,
    "name" text NOT NULL,
    "is_lir" smallint NOT NULL,
    "created" bigint NOT NULL,
    "modified" bigint NOT NULL
) WITH (oids = false);

CREATE TABLE "dump_ripe_organisations_1" (
    "id" serial NOT NULL,
    "org" character(255) NOT NULL,
    "name" text NOT NULL,
    "is_lir" smallint NOT NULL,
    "created" bigint NOT NULL,
    "modified" bigint NOT NULL
) WITH (oids = false);


CREATE TABLE "dump_ripe_routes_0" (
    "id" serial NOT NULL,
    "version" smallint NOT NULL,
    "block" inet NOT NULL,
    "block_start" inet NOT NULL,
    "block_end" inet NOT NULL,
    "description" text NOT NULL,
    "origin" bigint NOT NULL,
    "created" bigint NOT NULL,
    "modified" bigint NOT NULL
) WITH (oids = false);

CREATE TABLE "dump_ripe_routes_1" (
    "id" serial NOT NULL,
    "version" smallint NOT NULL,
    "block" inet NOT NULL,
    "block_start" inet NOT NULL,
    "block_end" inet NOT NULL,
    "description" text NOT NULL,
    "origin" bigint NOT NULL,
    "created" bigint NOT NULL,
    "modified" bigint NOT NULL
) WITH (oids = false);

CREATE TABLE "podi_departments" (
    "id" serial NOT NULL,
    "public_id" character(3) NOT NULL,
    "name" character(50) NOT NULL
) WITH (oids = false);

CREATE TABLE "podi_nra" (
    "id" serial,
    "name" character(5) NOT NULL,
    "department" smallint NOT NULL,
    "region" smallint NOT NULL,
    "city" text NOT NULL,
    "lines_start" integer NOT NULL,
    "lines_end" integer NOT NULL,
    "type" smallint NOT NULL
) WITH (oids = false);

CREATE TABLE "podi_regions" (
    "id" serial,
    "name" character(50) NOT NULL
) WITH (oids = false);

CREATE TABLE "proxys" (
    "id" serial NOT NULL,
    "ip" inet NOT NULL,
    "port" integer NOT NULL,
    "timestamp" bigint NOT NULL
) WITH (oids = false);

CREATE SEQUENCE ptr_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 START 1 CACHE 1;

CREATE TABLE "ptr" (
    "id" integer DEFAULT nextval('ptr_id_seq') NOT NULL,
    "ip" inet NOT NULL,
    "ptr" text NOT NULL,
    CONSTRAINT "ptr_id" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE INDEX "ptr_ip" ON "ptr" USING btree ("ip");
CREATE INDEX ON ptr USING gin (ptr gin_trgm_ops);


CREATE SEQUENCE cache_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 START 1 CACHE 1;

CREATE TABLE "cache" (
    "id" integer DEFAULT nextval('cache_id_seq') NOT NULL,
    "name" character(255) NOT NULL,
    "value" text NOT NULL,
    "expiration" bigint NOT NULL
) WITH (oids = false);



/* bgp_events */
ALTER TABLE "bgp_events" ADD CONSTRAINT "bgp_events_id" PRIMARY KEY ("id");
CREATE INDEX ON bgp_events USING gist (block inet_ops);
CREATE INDEX ON bgp_events USING gist (block_start inet_ops);
CREATE INDEX ON bgp_events USING gist (block_end inet_ops);
CREATE INDEX ON bgp_events USING btree ("timestamp");


/* bgp_routes */
ALTER TABLE "bgp_routes" ADD CONSTRAINT "bgp_routes_id" PRIMARY KEY ("id");
CREATE INDEX ON bgp_routes USING gist (block inet_ops);
CREATE INDEX ON bgp_routes USING gist (block_start inet_ops);
CREATE INDEX ON bgp_routes USING gist (block_end inet_ops);
CREATE INDEX ON "bgp_routes" USING btree ("timestamp");


/* dump_as_0 */
ALTER TABLE "dump_as_0" ADD CONSTRAINT "dump_as_0_id" PRIMARY KEY ("id");
CREATE INDEX ON dump_as_0 USING gin (name gin_trgm_ops);
CREATE INDEX ON "dump_as_0" USING btree ("country");


/* dump_as_1 */
ALTER TABLE "dump_as_1" ADD CONSTRAINT "dump_as_1_id" PRIMARY KEY ("id");
CREATE INDEX ON dump_as_1 USING gin (name gin_trgm_ops);
CREATE INDEX ON "dump_as_1" USING btree ("country");


/* dump_blocks_0 */
ALTER TABLE "dump_blocks_0" ADD CONSTRAINT "dump_blocks_0_id" PRIMARY KEY ("id");
CREATE INDEX ON dump_blocks_0 USING gist (block inet_ops);
CREATE INDEX ON dump_blocks_0 USING gist (block_start inet_ops);
CREATE INDEX ON dump_blocks_0 USING gist (block_end inet_ops);
CREATE INDEX ON dump_blocks_0 USING btree ("lir");


/* dump_blocks_1 */
ALTER TABLE "dump_blocks_1" ADD CONSTRAINT "dump_blocks_1_id" PRIMARY KEY ("id");
CREATE INDEX ON dump_blocks_1 USING gist (block inet_ops);
CREATE INDEX ON dump_blocks_1 USING gist (block_start inet_ops);
CREATE INDEX ON dump_blocks_1 USING gist (block_end inet_ops);
CREATE INDEX ON dump_blocks_1 USING btree ("lir");


/* dump_lir_0 */
ALTER TABLE "dump_lir_0" ADD CONSTRAINT "dump_lir_0_id" PRIMARY KEY ("id");
CREATE INDEX ON "dump_lir_0" USING btree ("created");


/* dump_lir_1 */
ALTER TABLE "dump_lir_1" ADD CONSTRAINT "dump_lir_1_id" PRIMARY KEY ("id");
CREATE INDEX ON "dump_lir_1" USING btree ("created");


/* dump_ripe_allocations_0 */
ALTER TABLE "dump_ripe_allocations_0" ADD CONSTRAINT "dump_ripe_allocations_0_id" PRIMARY KEY ("id");
CREATE INDEX ON dump_ripe_allocations_0 USING gist (block inet_ops);
CREATE INDEX ON dump_ripe_allocations_0 USING gist (block_start inet_ops);
CREATE INDEX ON dump_ripe_allocations_0 USING gist (block_end inet_ops);
CREATE INDEX ON dump_ripe_allocations_0 USING btree ("org");
CREATE INDEX ON dump_ripe_allocations_0 USING btree ("country");
CREATE INDEX ON dump_ripe_allocations_0 USING gin (netname gin_trgm_ops);
CREATE INDEX ON dump_ripe_allocations_0 USING gin (description gin_trgm_ops);
CREATE INDEX ON dump_ripe_allocations_0 USING gin (remarks gin_trgm_ops);
CREATE INDEX ON dump_ripe_allocations_0 USING btree ("created");
CREATE INDEX ON dump_ripe_allocations_0 ("status");


/* dump_ripe_allocations_1 */
ALTER TABLE "dump_ripe_allocations_1" ADD CONSTRAINT "dump_ripe_allocations_1_id" PRIMARY KEY ("id");
CREATE INDEX ON dump_ripe_allocations_1 USING gist (block inet_ops);
CREATE INDEX ON dump_ripe_allocations_1 USING gist (block_start inet_ops);
CREATE INDEX ON dump_ripe_allocations_1 USING gist (block_end inet_ops);
CREATE INDEX ON dump_ripe_allocations_1 USING btree ("org");
CREATE INDEX ON dump_ripe_allocations_1 USING btree ("country");
CREATE INDEX ON dump_ripe_allocations_1 USING gin (netname gin_trgm_ops);
CREATE INDEX ON dump_ripe_allocations_1 USING gin (description gin_trgm_ops);
CREATE INDEX ON dump_ripe_allocations_1 USING gin (remarks gin_trgm_ops);
CREATE INDEX ON dump_ripe_allocations_1 USING btree ("created");
CREATE INDEX ON dump_ripe_allocations_1 ("status");


/* dump_ripe_as_0 */
ALTER TABLE "dump_ripe_as_0" ADD CONSTRAINT "dump_ripe_as_0_id" PRIMARY KEY ("id");
CREATE INDEX ON dump_ripe_as_0 USING btree ("org");
CREATE INDEX ON dump_ripe_as_0 USING btree ("sponsoring_org");
CREATE INDEX ON dump_ripe_as_0 USING gin (description gin_trgm_ops);
CREATE INDEX ON dump_ripe_as_0 USING gin (remarks gin_trgm_ops);
CREATE INDEX ON dump_ripe_as_0 USING btree ("created");


/* dump_ripe_as_1 */
ALTER TABLE "dump_ripe_as_1" ADD CONSTRAINT "dump_ripe_as_1_id" PRIMARY KEY ("id");
CREATE INDEX ON dump_ripe_as_1 USING btree ("org");
CREATE INDEX ON dump_ripe_as_1 USING btree ("sponsoring_org");
CREATE INDEX ON dump_ripe_as_1 USING gin (description gin_trgm_ops);
CREATE INDEX ON dump_ripe_as_1 USING gin (remarks gin_trgm_ops);
CREATE INDEX ON dump_ripe_as_1 USING btree ("created");


/* dump_ripe_as_peers_0 */
ALTER TABLE "dump_ripe_as_peers_0" ADD CONSTRAINT "dump_ripe_as_peers_0_id" PRIMARY KEY ("id");
CREATE INDEX ON dump_ripe_as_peers_0 USING btree ("asn");
CREATE INDEX ON dump_ripe_as_peers_0 USING btree ("peer");


/* dump_ripe_as_peers_1 */
ALTER TABLE "dump_ripe_as_peers_1" ADD CONSTRAINT "dump_ripe_as_peers_1_id" PRIMARY KEY ("id");
CREATE INDEX ON dump_ripe_as_peers_1 USING btree ("asn");
CREATE INDEX ON dump_ripe_as_peers_1 USING btree ("peer");


/* dump_ripe_organisations_0 */
ALTER TABLE "dump_ripe_organisations_0" ADD CONSTRAINT "dump_ripe_organisations_0_id" PRIMARY KEY ("id");
CREATE INDEX ON dump_ripe_organisations_0 USING btree ("org");
CREATE INDEX ON dump_ripe_organisations_0 USING gin (name gin_trgm_ops);
CREATE INDEX ON dump_ripe_organisations_0 USING btree ("created");


/* dump_ripe_organisations_1 */
ALTER TABLE "dump_ripe_organisations_1" ADD CONSTRAINT "dump_ripe_organisations_1_id" PRIMARY KEY ("id");
CREATE INDEX ON dump_ripe_organisations_1 USING btree ("org");
CREATE INDEX ON dump_ripe_organisations_1 USING gin (name gin_trgm_ops);
CREATE INDEX ON dump_ripe_organisations_1 USING btree ("created");


/* dump_ripe_routes_0 */
ALTER TABLE "dump_ripe_routes_0" ADD CONSTRAINT "dump_ripe_routes_0_id" PRIMARY KEY ("id");
CREATE INDEX ON dump_ripe_routes_0 USING gist (block inet_ops);
CREATE INDEX ON dump_ripe_routes_0 USING gist (block_start inet_ops);
CREATE INDEX ON dump_ripe_routes_0 USING gist (block_end inet_ops);
CREATE INDEX ON dump_ripe_routes_0 USING gin (description gin_trgm_ops);
CREATE INDEX ON dump_ripe_routes_0 USING btree ("origin");
CREATE INDEX ON dump_ripe_routes_0 USING btree ("created");


/* dump_ripe_routes_1 */
ALTER TABLE "dump_ripe_routes_1" ADD CONSTRAINT "dump_ripe_routes_1_id" PRIMARY KEY ("id");
CREATE INDEX ON dump_ripe_routes_1 USING gist (block inet_ops);
CREATE INDEX ON dump_ripe_routes_1 USING gist (block_start inet_ops);
CREATE INDEX ON dump_ripe_routes_1 USING gist (block_end inet_ops);
CREATE INDEX ON dump_ripe_routes_1 USING gin (description gin_trgm_ops);
CREATE INDEX ON dump_ripe_routes_1 USING btree ("origin");
CREATE INDEX ON dump_ripe_routes_1 USING btree ("created");


/* podi_departments */
ALTER TABLE "podi_departments" ADD CONSTRAINT "podi_departments_id" PRIMARY KEY ("id");
CREATE INDEX ON podi_departments USING btree ("public_id");


/* podi_nra */
ALTER TABLE "podi_nra" ADD CONSTRAINT "podi_nra_id" PRIMARY KEY ("id");
CREATE INDEX ON podi_nra USING gin (city gin_trgm_ops);


/* podi_regions */
ALTER TABLE "podi_regions" ADD CONSTRAINT "podi_regions_id" PRIMARY KEY ("id");


/* proxys */
ALTER TABLE "proxys" ADD CONSTRAINT "proxys_id" PRIMARY KEY ("id");



-- Adminer 4.7.8 PostgreSQL dump

DROP TABLE IF EXISTS "invoices";
DROP SEQUENCE IF EXISTS invoices_id_seq;
CREATE SEQUENCE invoices_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 START 1 CACHE 1;

CREATE TABLE "public"."invoices" (
    "id" integer DEFAULT nextval('invoices_id_seq') NOT NULL,
    "recipient" text NOT NULL,
    "products" text NOT NULL,
    "user_email" character(100) NOT NULL,
    "timestamp" bigint NOT NULL,
    CONSTRAINT "invoices_id" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE INDEX "invoices_user_email" ON "public"."invoices" USING btree ("user_email");


DROP TABLE IF EXISTS "ip_logs";
DROP SEQUENCE IF EXISTS ip_logs_id_seq;
CREATE SEQUENCE ip_logs_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 START 1 CACHE 1;

CREATE TABLE "public"."ip_logs" (
    "id" integer DEFAULT nextval('ip_logs_id_seq') NOT NULL,
    "ip" inet NOT NULL,
    "owner" character(100) NOT NULL,
    "timestamp_start" bigint NOT NULL,
    "timestamp_end" bigint NOT NULL,
    CONSTRAINT "ip_logs_id" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE INDEX "ip_logs_ip" ON "public"."ip_logs" USING btree ("ip");


DROP TABLE IF EXISTS "paypal";
DROP SEQUENCE IF EXISTS paypal_id_seq;
CREATE SEQUENCE paypal_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 START 1 CACHE 1;

CREATE TABLE "public"."paypal" (
    "id" integer DEFAULT nextval('paypal_id_seq') NOT NULL,
    "payment_id" character(30) NOT NULL,
    "price" numeric NOT NULL,
    "user_email" character(100) NOT NULL,
    "product" smallint NOT NULL,
    "paid" smallint DEFAULT '0' NOT NULL,
    "service" inet NOT NULL,
    CONSTRAINT "paypal_id" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE INDEX "paypal_paid" ON "public"."paypal" USING btree ("paid");

CREATE INDEX "paypal_payment_id" ON "public"."paypal" USING btree ("payment_id");


DROP TABLE IF EXISTS "servers";
DROP SEQUENCE IF EXISTS servers_id_seq;
CREATE SEQUENCE servers_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 START 1 CACHE 1;

CREATE TABLE "public"."servers" (
    "id" integer DEFAULT nextval('servers_id_seq') NOT NULL,
    "ip" inet NOT NULL,
    "password" character(32) NOT NULL,
    "owner" character(100) DEFAULT '' NOT NULL,
    "type" smallint NOT NULL,
    "expiration" bigint DEFAULT '0' NOT NULL,
    "hypervisor" character(50) NOT NULL,
    "hypervisor_password" character(32) DEFAULT '' NOT NULL,
    CONSTRAINT "servers_id" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE INDEX "servers_expiration" ON "public"."servers" USING btree ("expiration");

CREATE INDEX "servers_owner" ON "public"."servers" USING btree ("owner");

CREATE INDEX "servers_type" ON "public"."servers" USING btree ("type");


DROP TABLE IF EXISTS "users";
DROP SEQUENCE IF EXISTS users_id_seq;
CREATE SEQUENCE users_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 START 1 CACHE 1;

CREATE TABLE "public"."users" (
    "id" integer DEFAULT nextval('users_id_seq') NOT NULL,
    "email" character(100) NOT NULL,
    "password" character(255) NOT NULL,
    "firstname" character(100) NOT NULL,
    "lastname" character(100) NOT NULL,
    "address" character(100) NOT NULL,
    "postalcode" character(100) NOT NULL,
    "city" character(100) NOT NULL,
    "country" character(100) NOT NULL,
    "company" character(100) DEFAULT '' NOT NULL,
    CONSTRAINT "users_id" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE INDEX "users_email" ON "public"."users" USING btree ("email");


DROP TABLE IF EXISTS "users_ips";
DROP SEQUENCE IF EXISTS users_ips_id_seq;
CREATE SEQUENCE users_ips_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 START 1 CACHE 1;

CREATE TABLE "public"."users_ips" (
    "id" integer DEFAULT nextval('users_ips_id_seq') NOT NULL,
    "email" character(100) NOT NULL,
    "ip" inet NOT NULL,
    "port" integer NOT NULL,
    "timestamp" bigint NOT NULL,
    CONSTRAINT "users_ips_id" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE INDEX "users_ips_email" ON "public"."users_ips" USING btree ("email");

CREATE INDEX "users_ips_timestamp" ON "public"."users_ips" USING btree ("timestamp");
