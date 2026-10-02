# TODO für Claude: Hej-Lejo-Theme auf Staging einrichten

Diese Datei ist eine Arbeitsanweisung für Claude Code mit dem WordPress-MCP-Server
(`https://staging.hejlejo.de/wp-json/easy-mcp-ai/v1/mcp`). Ziel: Das Theme **Hej Lejo** auf der
Staging-Kopie vollständig nutzbar machen und prüfen, ob WordPress-, WooCommerce- und Plugin-Einstellungen
angepasst werden müssen.

---

## 0. Regeln (vor jedem Schritt beachten)

- [ ] **Nur Staging.** Vor jeder Änderung prüfen, dass `home`/`siteurl` auf `staging.hejlejo.de` zeigen.
      Zeigt irgendetwas auf `hejlejo.de` (Live), sofort abbrechen und melden.
- [ ] **Nichts an Produkten, Kategorien, Schlagwörtern, Attributen, Bestellungen, Kunden, Medien oder
      SEO-Daten (Rank Math) ändern.** Nur lesen. Das ist Phase 2.
- [ ] **Bestehende Seiten nicht überschreiben oder löschen.** Neue Seiten anlegen; alte Elementor-Seiten
      bleiben unangetastet (höchstens auf „Entwurf“ setzen, und nur nach Rückfrage).
- [ ] Vor jeder Einstellungsänderung den **alten Wert notieren** (für das Protokoll in Schritt 9).
- [ ] Bei Unklarheiten oder wenn ein Schritt nicht wie beschrieben möglich ist: **nachfragen statt raten.**
- [ ] Keine Plugins installieren, löschen oder aktualisieren ohne Rückfrage.

---

## 1. Bestandsaufnahme (nur lesen)

- [ ] WordPress-Version (Theme braucht ≥ 6.7), PHP-Version (≥ 8.0), WooCommerce-Version (≥ 9.5),
      Germanized-Version (≥ 3.14, besser aktuell).
- [ ] Aktives Theme – ist **Hej Lejo** (`hejlejo`) installiert und aktiv? Falls nicht: melden, nicht selbst aktivieren
      ohne Rückfrage.
- [ ] Liste aller aktiven Plugins.
- [ ] Einstellungen → Lesen: `show_on_front`, `page_on_front`, `page_for_posts`, „Suchmaschinen abhalten“.
- [ ] Einstellungen → Permalinks: Struktur (sollte `/%postname%/` sein).
- [ ] WooCommerce-Seiten: Shop, Warenkorb, Kasse, Mein Konto, AGB – IDs, Slugs und **Inhalt**
      (Block `woocommerce/cart` / `woocommerce/checkout` oder Shortcode `[woocommerce_cart]` / `[woocommerce_checkout]`?).
- [ ] Germanized-Rechtsseiten: Impressum, Datenschutz, Widerruf, Versandarten, Zahlungsarten – zugeordnet?
- [ ] Vorhandene Seiten mit den Slugs `startseite`, `schranklaedchen`, `ueber-uns`, `fuer-dein-laedchen`,
      `blog`, `newsletter`, `kontakt` – existieren sie? Mit welchem Inhalt (Elementor?)?
- [ ] Produktkategorien und Schlagwörter: **nur Slugs auflisten** (für die Kachel-/Menülinks, siehe Schritt 5).
- [ ] Gibt es Einträge in `wp_template` / `wp_template_part` (Anpassungen im Site Editor)? Nur auflisten.

**Ergebnis kurz zusammenfassen und bei Abweichungen von den Mindestversionen stoppen.**

---

## 2. Staging absichern (Einstellungen)

Diese Punkte schützen echte Kunden. Prüfen und – nach Rückfrage – umstellen:

| Bereich | Soll auf Staging | Warum |
|---|---|---|
| Einstellungen → Lesen → Suchmaschinen | **abhalten aktiviert** | Kopie nicht indexieren |
| FluentSMTP | **Mails nicht versenden** / Logging-only | keine Bestellmails an echte Kunden |
| WooPayments | **Testmodus** | keine echten Zahlungen |
| WooCommerce PayPal Payments | **Sandbox** | keine echten Zahlungen |
| UpdraftPlus | **automatische Backups aus** | schreibt sonst in den Live-Backup-Speicher |
| Shiptastic / DHL / UPS | keine Live-Labels erzeugen | keine Versandkosten |
| Rank Math | keine Sitemap-Pings | Kopie nicht melden |

---

## 3. Seiten mit den Theme-Patterns anlegen

Das Theme liefert komplette Seiten als Patterns. Eine Seite wird angelegt, indem ihr Inhalt **genau** das
Pattern-Block-Markup ist (WordPress expandiert es beim Rendern bzw. beim ersten Öffnen im Editor).

| Seite (Titel) | Slug | Inhalt (`post_content`) | Template (`_wp_page_template`) |
|---|---|---|---|
| Startseite (neu) | `startseite-neu` | `<!-- wp:pattern {"slug":"hejlejo/page-home"} /-->` | *(Standard – Startseite nutzt automatisch `front-page`)* |
| Schranklädchen | `schranklaedchen` | `<!-- wp:pattern {"slug":"hejlejo/page-schranklaedchen"} /-->` | `page-landing` |
| Über uns | `ueber-uns` | `<!-- wp:pattern {"slug":"hejlejo/page-about"} /-->` | `page-landing` |
| Für dein Lädchen | `fuer-dein-laedchen` | `<!-- wp:pattern {"slug":"hejlejo/page-business"} /-->` | `page-landing` |
| Blog | `blog` | *(leer)* | *(Standard)* |

- [ ] Seiten zunächst als **Entwurf** anlegen.
- [ ] Existiert der Slug schon (alte Elementor-Seite): **nicht überschreiben**, sondern melden. Optionen
      für die Rückfrage: alte Seite in `…-alt` umbenennen oder neue Seite mit anderem Slug + Menü anpassen.
- [ ] Nach Freigabe veröffentlichen.

### Startseite und Blog zuordnen (Einstellungen → Lesen)

- [ ] `show_on_front` = `page`
- [ ] `page_on_front` = ID von „Startseite (neu)“ (alten Wert notieren → Rückweg)
- [ ] `page_for_posts` = ID von „Blog“

---

## 4. WooCommerce-Einstellungen prüfen

- [ ] **Warenkorb- und Kassenseite:** Inhalt prüfen. Das Theme funktioniert mit Block **und** Shortcode.
      Empfehlung: Blöcke (`woocommerce/cart`, `woocommerce/checkout`) – Germanized, WooPayments und PayPal
      unterstützen sie. **Nicht selbst umstellen**, nur Empfehlung melden; die Umstellung erst nach einem
      Testkauf im Testmodus.
- [ ] **Steueranzeige:** WooCommerce → Einstellungen → MwSt. → „Preise im Shop anzeigen“ = **inkl. MwSt.**,
      „Preise im Warenkorb/Kasse anzeigen“ = **inkl. MwSt.** (Endkunden-Shop in DE). Nur melden, falls abweichend.
- [ ] **Produktbilder:** Das Theme setzt Vorschaubilder auf 600 px und Einzelbild auf 1000 px. Nach Theme-Wechsel
      melden, dass Thumbnails ggf. neu erzeugt werden sollten (Plugin „Regenerate Thumbnails“) – nicht selbst
      installieren.
- [ ] **„Demnächst verfügbar“-Modus** (WooCommerce → Einstellungen → Sichtbarkeit der Website): Status melden.
      Auf Staging ist „Demnächst verfügbar“ okay, solange angemeldete Admins den Shop sehen.
- [ ] Permalinks: Basis für Produkte/Kategorien notieren (Theme verlinkt dynamisch, keine Änderung nötig).

---

## 5. Germanized prüfen (rechtlich wichtig)

Germanized gibt in Block-Themes die Preisangaben **nicht automatisch** aus. Das Theme enthält dafür die
Germanized-Blöcke (Grundpreis, MwSt.-Hinweis, Versandkosten, Lieferzeit, Mängelbeschreibung).

- [ ] Germanized → Preisauszeichnungen: Sind Steuer-, Versandkosten-, Grundpreis- und Lieferzeit-Hinweise für
      **Einzelprodukt** und **Produktübersicht** aktiviert? Status melden.
- [ ] Germanized-Seitenzuordnung (Impressum, Datenschutz, AGB, Widerruf, Versandarten, Zahlungsarten)
      vollständig? Fehlende Zuordnungen melden – der Footer verlinkt diese Seiten.
- [ ] Ist eine **Kleinunternehmer-Regelung** (§ 19 UStG) eingestellt? Dann erscheint statt „inkl. MwSt.“ der
      Kleinunternehmer-Hinweis – melden, damit der Footer-Text „Alle Preise inkl. gesetzl. MwSt.“ angepasst wird.
- [ ] Kasse (Block): Sind die Germanized-Checkboxen (AGB/Widerruf, ggf. digitale Produkte „Verzicht auf
      Widerrufsrecht“) vorhanden?

---

## 6. Plugins: Kompatibilität und Ablösung

- [ ] **FiboSearch:** aktiv? Das Theme ersetzt die Header-Lupe automatisch. In FiboSearch die Option
      „Suchleisten des Themes ersetzen“ **aus** lassen (sonst doppelt). Melden, falls aktiv.
- [ ] **Product Variation Swatches:** aktiv? Auf einer variablen Produktseite prüfen, ob die Swatches erscheinen.
- [ ] **LiteSpeed Cache:** Nach dem Theme-Wechsel Cache leeren. Prüfen, ob „CSS/JS kombinieren“ oder
      „Unused CSS entfernen“ aktiv ist – falls Darstellungsfehler: diese Optionen als Ursache melden.
- [ ] **Real Cookie Banner:** Banner erscheint und lässt sich schließen? (Das Theme lädt keine externen Dienste.)
- [ ] **Kandidaten zum Deaktivieren** (nur auflisten, **nicht** deaktivieren):
      Elementor (erst wenn alle Elementor-Seiten ersetzt sind), Max Mega Menu, StoreCustomizer,
      Spiraclethemes Site Library, WP Child Theme Generator, Side Cart WooCommerce, OMGF.
      Für jedes Plugin angeben, welche Seiten/Funktionen es aktuell noch nutzen.

---

## 7. Inhalte im Theme anpassen (nur nach Rückfrage)

Diese Inhalte sind Beispiel- bzw. Platzhaltertexte im Theme. Liste erstellen, was angepasst werden muss,
und mit der Betreiberin klären:

- [ ] Kachel- und Menülinks: Das Theme verlinkt auf eine **vorhandene** Kategorie mit passendem Slug
      (z. B. `kerzentattoos`, `wasserschiebefolie`, `druckvorlagen`, `plotterdateien`, `herbst`, `weihnachten`),
      sonst auf die Produktsuche. Abgleich mit den echten Kategorie-Slugs aus Schritt 1 erstellen:
      welche Links treffen, welche fallen auf die Suche zurück.
- [ ] Schranklädchen: Adresse, Öffnungszeiten, Bezahlung (Platzhalter „Musterstraße 1“).
- [ ] Produktseite, Akkordeon „Gut zu wissen“: Versand-/Download-, Lizenz- und Anwendungstexte.
- [ ] Hinweisleiste: „Neue Herbstkollektion ist da“ usw.
- [ ] Social-Links im Footer (Instagram `hej.lejo`, Pinterest-Link ist ein Platzhalter).
- [ ] Logo: Gibt es ein Logo in der Mediathek? Dann im Header den Block „Website-Logo“ befüllen.
- [ ] Freebie-Button verlinkt auf `/newsletter/` – existiert die Seite? Sonst melden.
- [ ] Platzhalterbilder (SVG-Illustrationen) → durch echte Fotos ersetzen (welche Fotos gibt es in der Mediathek?).

---

## 8. Prüfung im Frontend

Jede URL aufrufen und Auffälligkeiten melden (fehlende Inhalte, doppelte Elemente, falsche Links,
PHP-Fehler, leere Bereiche):

- [ ] `/` Startseite (alle Abschnitte: Hero, Kategorien, Anlässe, Neuheiten, Anleitung, Business/Freebie, Instagram)
- [ ] `/shop/` und eine Produktkategorie
- [ ] Einfaches Produkt, **variables** Produkt, **herunterladbares** Produkt – jeweils:
      Preis + „inkl. MwSt.“ + „zzgl. Versandkosten“ (bzw. bei Downloads ohne Versand), Grundpreis falls gepflegt,
      Lieferzeit, Badges, Produkt-Vorteile, Tabs, ähnliche Produkte
- [ ] Produktsuche (`/?s=kerze&post_type=product`) und FiboSearch im Header
- [ ] Warenkorb (Mini-Cart-Drawer im Header + Warenkorbseite)
- [ ] Kasse (im Testmodus bis zur Zahlungsauswahl; Germanized-Checkboxen sichtbar)
- [ ] Mein Konto (abgemeldet: Login/Registrierung)
- [ ] `/schranklaedchen/`, `/ueber-uns/`, `/fuer-dein-laedchen/`, `/blog/`, ein Blogbeitrag
- [ ] 404-Seite (`/gibt-es-nicht/`)
- [ ] Rechtsseiten aus dem Footer: alle Links führen auf existierende Seiten
- [ ] Mobile Ansicht (falls möglich): Burger-Menü, kein seitliches Scrollen

---

## 9. Abschlussbericht

Am Ende einen Bericht mit:

1. **Geänderte Einstellungen** – jeweils alter Wert → neuer Wert.
2. **Angelegte Seiten** – Titel, Slug, ID, Status.
3. **Offene Punkte**, die eine Entscheidung brauchen (z. B. Kasse auf Block umstellen, Slugs belegt,
   Kleinunternehmer-Hinweis, Plugins zum Deaktivieren).
4. **Gefundene Fehler** im Frontend mit URL und Beschreibung (für Theme-Korrekturen im Repo).
5. **Rückweg:** Wie die Startseite und das alte Theme wiederhergestellt werden
   (alter `page_on_front`-Wert, altes Theme unter Design → Themes aktivieren).
