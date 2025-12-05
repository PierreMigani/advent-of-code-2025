# Design Decisions and Trade-offs

This document explains key architectural decisions made in this project and the reasoning behind them.

## PSR-7 Implementation Approach

### Decision: Custom PSR-7 Implementation
**Why**: Instead of using libraries like Guzzle PSR-7 or Nyholm PSR-7, this project implements PSR-7 interfaces from scratch.

**Advantages**:
- ✅ Learning opportunity - understand HTTP message interfaces deeply
- ✅ Lightweight - no extra dependencies
- ✅ Full control over implementation
- ✅ Simple enough for the use case

**Trade-offs**:
- ⚠️ More code to maintain
- ⚠️ Less battle-tested than established libraries
- ⚠️ Some PSR-7 features may be incomplete

**Verdict**: ✅ **Good choice for Advent of Code** - The educational value and simplicity outweigh the drawbacks.

## Mutability in PSR-7 Objects

### Decision: Mutable `with*` methods
**Implementation**: Methods like `withStatus()`, `withHeader()` modify the object in place rather than returning a clone.

```php
// Current implementation (mutable)
public function withStatus(int $code, string $reasonPhrase = ''): ResponseInterface {
    $this->statusCode = $code;
    $this->reasonPhrase = $reasonPhrase;
    return $this;
}

// Strict PSR-7 (immutable)
public function withStatus(int $code, string $reasonPhrase = ''): ResponseInterface {
    $clone = clone $this;
    $clone->statusCode = $code;
    $clone->reasonPhrase = $reasonPhrase;
    return $clone;
}
```

**Advantages**:
- ✅ Simpler to understand
- ✅ Better performance (no cloning overhead)
- ✅ Works perfectly for the use case

**Trade-offs**:
- ⚠️ Not strictly PSR-7 compliant
- ⚠️ Could cause issues if objects are shared across requests (not applicable here)

**Verdict**: ✅ **Acceptable trade-off** - For a single-user development tool, the simplicity wins. The code is not building a library for others to use, and immutability would add unnecessary complexity.

## Routing Strategy

### Decision: Simple Pattern Matching
**Implementation**: Direct regex matching in `ControllerFactory` instead of a routing library.

```php
if (preg_match('/^\/day(\d+)$/', $path, $matches)) {
    $dayNumber = (int) $matches[1];
    // ...
}
```

**Advantages**:
- ✅ No dependencies
- ✅ Easy to understand
- ✅ Sufficient for the limited routes needed
- ✅ Fast performance

**Trade-offs**:
- ⚠️ Limited flexibility for complex routing
- ⚠️ No route parameters beyond day number
- ⚠️ Manual route definition

**Verdict**: ✅ **Perfect for this use case** - Advent of Code has a predictable URL structure. A full routing library would be overkill.

## Template Engine Choice

### Decision: League/Plates
**Why**: Chosen over Twig, Smarty, or Blade.

**Advantages**:
- ✅ Native PHP syntax (no new language to learn)
- ✅ Automatic escaping for security
- ✅ Template inheritance
- ✅ Lightweight
- ✅ No compilation step

**Trade-offs**:
- ⚠️ Less feature-rich than Twig
- ⚠️ No sandboxing

**Verdict**: ✅ **Great choice** - For a development tool with trusted users, native PHP templates are ideal.

## Service Interface Design

### Decision: Three-method interface (parse, computePartOne, computePartTwo)

```php
interface DayInterface {
    public function parse(array $inputLines): void;
    public function computePartOne(): mixed;
    public function computePartTwo(): mixed;
}
```

**Advantages**:
- ✅ Clear separation of concerns
- ✅ Matches Advent of Code structure (2 parts per day)
- ✅ Parse once, compute multiple times
- ✅ Flexible return types with `mixed`

**Trade-offs**:
- ⚠️ Requires state storage in service class
- ⚠️ Can't easily re-parse with different input

**Verdict**: ✅ **Well-designed** - Mirrors the Advent of Code problem structure perfectly.

## Dependency Management

### Decision: Minimal dependencies
**Current dependencies**:
- `league/plates` - Template engine
- `psr/http-*` - Interface definitions only

**Advantages**:
- ✅ Fast installation
- ✅ Fewer security concerns
- ✅ Easier to understand codebase
- ✅ No dependency conflicts

**Trade-offs**:
- ⚠️ More code to write
- ⚠️ Less features out of the box

**Verdict**: ✅ **Good balance** - The minimal dependency approach works well for this project's scope.

## Docker Configuration

### Decision: PHPDocker.io generated setup
**Implementation**: Uses pre-configured Docker images from phpdocker.io.

**Advantages**:
- ✅ Quick setup
- ✅ Production-ready configuration
- ✅ PHP 8.4 support
- ✅ Nginx + PHP-FPM split
- ✅ Documented in README

**Trade-offs**:
- ⚠️ Some unnecessary configuration
- ⚠️ Not optimized for this specific project

**Verdict**: ✅ **Smart choice** - Using a generator saves time and provides a solid foundation.

## Autoloading Strategy

### Decision: Custom autoloader + Composer
**Implementation**: Mix of `spl_autoload_register` and Composer's autoloader.

```php
function myAutoloader($className) {
    $className = str_replace('\\', '/', $className);
    $path = __DIR__ . '/../src/';
    include $path . $className . '.php';
}
spl_autoload_register('myAutoloader');
```

**Why**: The custom autoloader handles the project's classes, while Composer handles vendor dependencies.

**Advantages**:
- ✅ No need to configure Composer's PSR-4 in composer.json
- ✅ Simple and straightforward
- ✅ Works for flat namespace structure

**Trade-offs**:
- ⚠️ Could use Composer's PSR-4 instead for consistency
- ⚠️ Less standard than pure Composer autoloading

**Verdict**: ⚠️ **Works but could be improved** - Consider adding PSR-4 autoload in composer.json:

```json
{
    "autoload": {
        "psr-4": {
            "Controller\\": "src/Controller/",
            "Service\\": "src/Service/",
            "Factory\\": "src/Factory/"
        }
    }
}
```

## Error Handling

### Decision: Minimal error handling
**Current**: Basic 404 for unknown routes, PHP errors bubble up.

**Advantages**:
- ✅ Simple to understand
- ✅ Development-friendly (see all errors)
- ✅ Fast to implement

**Trade-offs**:
- ⚠️ Not production-ready
- ⚠️ Errors expose internal paths
- ⚠️ No friendly error pages

**Verdict**: ✅ **Acceptable for development tool** - This isn't a public website, so detailed errors are helpful.

## File Organization

### Decision: Namespace-based directories

```
src/
  Controller/
  Factory/
  Message/
  RequestHandler/
  Response/
  Service/
  Stream/
```

**Advantages**:
- ✅ Clear organization
- ✅ Matches PHP namespace structure
- ✅ Easy to find files
- ✅ Scalable

**Trade-offs**:
- ⚠️ Many directories for a small project
- ⚠️ Could group differently (e.g., by feature)

**Verdict**: ✅ **Professional structure** - May seem like overkill for a small project, but it sets up good patterns for growth.

## Summary of Recommendations

### Keep As-Is ✅
1. Custom PSR-7 implementation
2. Mutable with* methods
3. Simple routing
4. League/Plates templates
5. Service interface design
6. Minimal dependencies
7. Docker setup

### Consider Changing ⚠️
1. Add Composer PSR-4 autoloading
2. Add basic tests
3. Add input file storage
4. Add error handling for edge cases

### Future Enhancements 💡
1. Add PHPStan for static analysis
2. Add benchmarking for solution performance
3. Add input validation
4. Add result caching
5. Add database for result history (optional)

---

**Overall**: The design decisions in this project are well-thought-out and appropriate for its purpose. The trade-offs favor simplicity and learning, which is perfect for Advent of Code challenges.
