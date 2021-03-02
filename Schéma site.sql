-- Adminer 4.7.8 PostgreSQL dump

DROP TABLE IF EXISTS "hypervisors";
DROP SEQUENCE IF EXISTS hypervisors_id_seq;
CREATE SEQUENCE hypervisors_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 START 1 CACHE 1;

CREATE TABLE "public"."hypervisors" (
    "id" integer DEFAULT nextval('hypervisors_id_seq') NOT NULL,
    "password" character(16) NOT NULL,
    CONSTRAINT "hypervisors_id" PRIMARY KEY ("id")
) WITH (oids = false);


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


DROP TABLE IF EXISTS "minecraft_logs";
DROP SEQUENCE IF EXISTS minecraft_logs_id_seq;
CREATE SEQUENCE minecraft_logs_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 START 1 CACHE 1;

CREATE TABLE "public"."minecraft_logs" (
    "id" integer DEFAULT nextval('minecraft_logs_id_seq') NOT NULL,
    "session" character(40) NOT NULL,
    "source_ip" inet NOT NULL,
    "source_port" integer NOT NULL,
    "server_port" integer NOT NULL,
    "timestamp" bigint NOT NULL,
    CONSTRAINT "minecraft_logs_id" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "minecraft_servers";
DROP SEQUENCE IF EXISTS minecraft_servers_id_seq;
CREATE SEQUENCE minecraft_servers_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 START 1 CACHE 1;

CREATE TABLE "public"."minecraft_servers" (
    "id" integer DEFAULT nextval('minecraft_servers_id_seq') NOT NULL,
    "server_port" integer NOT NULL,
    "owner" character(40) DEFAULT '' NOT NULL,
    "rcon_port" integer NOT NULL,
    "rcon_password" character(40) NOT NULL,
    CONSTRAINT "minecraft_servers_id" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "minecraft_sessions";
DROP SEQUENCE IF EXISTS minecraft_sessions_id_seq;
CREATE SEQUENCE minecraft_sessions_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 START 1 CACHE 1;

CREATE TABLE "public"."minecraft_sessions" (
    "id" integer DEFAULT nextval('minecraft_sessions_id_seq') NOT NULL,
    "session" character(40) NOT NULL,
    "server_port" integer NOT NULL,
    "expiration" bigint DEFAULT '0' NOT NULL,
    "final_expiration" bigint DEFAULT '0' NOT NULL,
    CONSTRAINT "minecraft_sessions_id" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE INDEX "minecraft_sessions_session" ON "public"."minecraft_sessions" USING btree ("session");


DROP TABLE IF EXISTS "paypal";
DROP SEQUENCE IF EXISTS paypal_id_seq;
CREATE SEQUENCE paypal_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 START 1 CACHE 1;

CREATE TABLE "public"."paypal" (
    "id" integer DEFAULT nextval('paypal_id_seq') NOT NULL,
    "payment_id" character(40) NOT NULL,
    "price" numeric NOT NULL,
    "user_email" character(100) NOT NULL,
    "paid" smallint DEFAULT '0' NOT NULL,
    "product_type" smallint NOT NULL,
    "service" inet NOT NULL,
    CONSTRAINT "paypal_id" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE INDEX "paypal_paid" ON "public"."paypal" USING btree ("paid");


DROP TABLE IF EXISTS "proxys";
DROP SEQUENCE IF EXISTS proxys_id_seq;
CREATE SEQUENCE proxys_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 START 1 CACHE 1;

CREATE TABLE "public"."proxys" (
    "id" integer DEFAULT nextval('proxys_id_seq') NOT NULL,
    "ip" inet NOT NULL,
    "port" integer NOT NULL,
    "timestamp" bigint NOT NULL,
    CONSTRAINT "proxys_id" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "servers";
DROP SEQUENCE IF EXISTS servers_id_seq;
CREATE SEQUENCE servers_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 START 1 CACHE 1;

CREATE TABLE "public"."servers" (
    "id" integer DEFAULT nextval('servers_id_seq') NOT NULL,
    "user_email" character(100) NOT NULL,
    "password" character(16) NOT NULL,
    "expiration" bigint NOT NULL,
    "type" smallint NOT NULL,
    "ip" inet NOT NULL,
    "hypervisor_id" smallint NOT NULL,
    "proxmox_id" smallint NOT NULL,
    CONSTRAINT "servers_id" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE INDEX "servers_ip" ON "public"."servers" USING btree ("ip");

CREATE INDEX "servers_type" ON "public"."servers" USING btree ("type");

CREATE INDEX "servers_user_email" ON "public"."servers" USING btree ("user_email");


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
    "user_email" character(100) NOT NULL,
    "ip" inet NOT NULL,
    "port" integer NOT NULL,
    "timestamp" bigint NOT NULL,
    CONSTRAINT "users_ips_id" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE INDEX "users_ips_email" ON "public"."users_ips" USING btree ("user_email");

CREATE INDEX "users_ips_timestamp" ON "public"."users_ips" USING btree ("timestamp");


-- 2021-03-02 14:33:43.423181+01