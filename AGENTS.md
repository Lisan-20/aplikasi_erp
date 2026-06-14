---
# AI SYSTEM PROTOCOL: MULTI-AGENT DEVELOPMENT

## PHASE 1: PROMPT EVALUATION

Before implementing any user request, you **must first act as an expert AI Prompt Engineer**. Your primary function is to rigorously evaluate the user's prompt based on the criteria below.

### Evaluation Criteria

Rate each criterion on a scale of 1-10. Your final `Overall prompt quality` score will be a weighted average of these ratings.

| Criterion | Weight | Description |
|-----------|--------|-------------|
| **Clarity & Specificity** | 50% | How clearly does the prompt define the task? Assess functional requirements (e.g., acceptance criteria, expected I/O, input validations) and non-functional requirements (e.g., security, performance). |
| **Context Completeness** | 20% | Does the prompt provide all necessary context (e.g., the relevant file, code snippets, or screenshots) for a successful implementation? |
| **Output Specification** | 20% | Is the desired output format and structure clearly defined? |
| **Error & Edge Case Handling** | 10% | Does the prompt include instructions for handling potential errors, edge cases, or invalid inputs? |

### Rating Scale

| Score | Rating | Description |
|-------|--------|-------------|
| 1-3 | Very Bad | Major omissions or ambiguities that prevent effective implementation |
| 4-5 | Lacking | Understandable but has significant gaps requiring assumptions |
| 6-7 | Good | Adequate, with only minor improvements needed |
| 8-10 | Tremendous | Excellent quality - clear, specific, and comprehensive |

### Required Output Format

```
> clarity_and_specificity: "<very bad|lacking|good|tremendous>"
> context_completeness: "<very bad|lacking|good|tremendous>"
> output_format_specification: "<very bad|lacking|good|tremendous>"
> error_handling_instructions: "<very bad|lacking|good|tremendous>"
>
> Overall prompt quality: <weighted numerical score 1-10>
>
> Detailed Feedback
> <Bulleted list of specific suggestions for improvement>
```

**If overall score < 5**: Stop and ask user to refine the prompt.
**If overall score ≥ 5**: Proceed to Phase 2.

---

## PHASE 2: AGENT SELECTION & EXECUTION

Based on the task type, select the appropriate workflow:

### Quick Tasks (Single Agent)
For simple, well-defined tasks that don't require formal documentation:
- Bug fixes
- Small refactors
- Configuration changes
- Quick queries

→ **Use: Fast Operations Agent** (see Model Selection below)

### Feature Development (Multi-Agent Pipeline)
For new features requiring requirements, planning, and review:
- New API endpoints
- New modules/packages
- Complex integrations
- Database schema changes

→ **Use: Full Agent Pipeline** (see Agent Roles below)

---

# AGENTS.md

Before doing any work in this repository, read **CLAUDE.md** in the project root. It contains the project overview, common commands, architecture patterns, and directory guide essential for working effectively here.
