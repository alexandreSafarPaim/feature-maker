<div align="center">

# Laravel Feature Maker

[![Laravel][laravel-badge]][laravel-url]
[![License: MIT][license-badge]][license-url]

</div>

**Laravel Feature Maker** é um gerador de scaffolding para projetos Laravel, criado para acelerar o desenvolvimento e padronizar a estrutura de código por feature. Ideal para software houses e times que trabalham com projetos em larga escala e querem reutilizar funcionalidades de forma modular.

---

## Sumário 📚

- [Instalação 🚀](#instalação-🚀)
- [Como Funciona ⚙️](#como-funciona-⚙️)
- [Uso do Comando 🧪](#uso-do-comando-🧪)
- [Padrões Gerados ✨](#padrões-gerados-✨)
- [Personalização 🧰](#personalização-🧰)
- [Boas Práticas ✅](#boas-práticas-✅)
- [Licença 📄](#licença-📄)

---

## Instalação 🚀

Adicione no seu `composer.json`:

```json
"repositories": [
  {
    "type": "vcs",
    "url": "https://github.com/suaempresa/laravel-feature-maker"
  }
]
```

Instale com:

```bash
composer require suaempresa/feature-maker
```

> 💡 Recomendamos **não instalar como `--dev`** para garantir que as migrations customizadas sejam carregadas corretamente em produção.

---

## Como Funciona ⚙️

O comando `php artisan make:feature` gera a estrutura completa de uma feature, baseada em stubs personalizados.

Pastas geradas:
```
app/Features/NomeDaFeature/
├── Controllers/
├── Models/
├── Requests/
├── Resources/
├── Migrations/
```

Arquivos são criados com base nas opções que você passa ao comando.

---

## Uso do Comando 🧪

```bash
php artisan make:feature NomeDaFeature [--controller|-c] [--migration|-m]
```

### Exemplos

Criar tudo:
```bash
php artisan make:feature Produto -c -m
```

Criar apenas model e migration:
```bash
php artisan make:feature Categoria --migration
```

Criar apenas as pastas da feature:
```bash
php artisan make:feature IntegracaoPagarme
```

> As pastas são sempre criadas mesmo se nenhum arquivo for gerado (útil para organização e versionamento).

---

## Padrões Gerados ✨

- **Model** com:
  - `fillable`, `casts`, `HasFactory`
  - `scopeFilter()` pronto para pesquisa via `?search=...`

- **Controller (REST API)** com:
  - Index paginado com filtro
  - Store, Show, Update, Destroy
  - Usa FormRequests e Resources

- **Requests** com:
  - Arquivos separados para `Store` e `Update`

- **Resources** com:
  - Resource para transformar o model em JSON

- **Migration** com:
  - Nome da tabela automaticamente pluralizado e convertido para snake_case

---

## Personalização 🧰

Você pode editar os stubs em:
```
src/stubs/
```
Para adaptar os arquivos gerados ao seu padrão de projeto (adicionar soft deletes, timestamps customizados, relations, etc.).

---

## Boas Práticas ✅

- Modularização por feature (inspirado em DDD-lite)
- Reutilização via copy/paste facilitada
- Pronto para CI/CD (sem dependências de execução runtime)
- Pode ser versionado e distribuído internamente por GitHub ou repositórios privados

---

## Licença 📄

MIT — Livre para uso comercial e pessoal. Mantenha os créditos ;)

---

[laravel-badge]: https://img.shields.io/badge/Laravel-Framework-red
[laravel-url]: https://laravel.com
[license-badge]: https://img.shields.io/github/license/suaempresa/laravel-feature-maker
[license-url]: https://github.com/suaempresa/laravel-feature-maker/blob/main/LICENSE